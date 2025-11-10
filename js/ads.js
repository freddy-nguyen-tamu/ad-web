// wp-content/themes/acme-ads/js/ads.js
(function(window, document, fetch){
  if (!window.AcmeAds) return;
  const ajax = window.AcmeAds.ajax_url;
  const nonce = window.AcmeAds.nonce;

  // Record ad click
  document.addEventListener('click', function(e){
    const el = e.target.closest('.ad-click');
    if (!el) return;
    const adId = el.dataset.adId || (el.closest('.acme-ad') && el.closest('.acme-ad').dataset.adId);
    if (!adId) return;
    // fire and forget
    fetch(ajax, {
      method: 'POST',
      body: new URLSearchParams({
        action: 'acme_record_click',
        ad_id: adId,
        nonce: nonce
      })
    });
  });

  // Fetch & rotate ads in a zone
  async function loadAdForZone(zone, container) {
    try {
      const data = await fetch(ajax + '?action=acme_get_random_ad&zone=' + encodeURIComponent(zone) + '&nonce=' + encodeURIComponent(nonce), { credentials: 'same-origin' });
      const json = await data.json();
      if (!json.success) return;
      const ad = json.data;
      container.innerHTML = renderAdHtml(ad);
    } catch(err){
      // swallow
      // console.error(err);
    }
  }

  function renderAdHtml(ad) {
    const img = ad.image ? `<div class="acme-ad-media"><img src="${ad.image}" alt="${escapeHtml(ad.title)}" style="max-width:100%;height:auto;border-radius:8px;" /></div>` : '';
    const cta = ad.cta ? `<p><a class="btn acme-ad-cta ad-click" href="${escapeHtml(ad.cta)}" target="_blank" rel="nofollow noopener noreferrer" data-ad-id="${ad.id}">Learn more</a></p>` : '';
    return `<div class="acme-ad" data-ad-id="${ad.id}">${img}<div class="acme-ad-body"><h4 class="acme-ad-title">${escapeHtml(ad.title)}</h4><div class="acme-ad-content">${ad.content}</div>${cta}</div></div>`;
  }

  function escapeHtml(s){ return String(s).replace(/[&<>"']/g, function(m){return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'}[m]; }); }

  // Initialize zones on DOMContentLoaded
  document.addEventListener('DOMContentLoaded', function(){
    // for each zone container, if it has data-zone attribute we'll load via AJAX for rotation
    const zones = document.querySelectorAll('.acme-ad-zone[data-zone]');
    zones.forEach(function(container){
      const zone = container.getAttribute('data-zone');
      // initial load via AJAX (even if server had server-side ad)
      loadAdForZone(zone, container);
      // rotate every 8s
      setInterval(function(){ loadAdForZone(zone, container); }, 8000);
    });
  });

})(window, document, fetch);
