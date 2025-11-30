document.addEventListener("DOMContentLoaded", () => {
  if (window.AOS) {
    AOS.init({ duration: 900, easing: "ease-out-cubic", once: true, offset: 80 });
  }

  // موبایل منو
  const toggle = document.querySelector(".nav-toggle");
  const menu = document.querySelector("#primary-menu");
  if (toggle && menu) {
    toggle.addEventListener("click", () => {
      const open = menu.classList.toggle("open");
      toggle.setAttribute("aria-expanded", open ? "true" : "false");
    });
  }

  // اسکرول نرم برای لینک‌های لنگر
  document.querySelectorAll('a[href^="#"]').forEach(a=>{
    a.addEventListener("click", (e)=>{
      const id = a.getAttribute("href");
      const el = document.querySelector(id);
      if(!el) return;
      e.preventDefault();
      window.scrollTo({ top: el.offsetTop - 90, behavior:"smooth" });
    });
  });

  // Parallax اپل‌مانند با GSAP/ScrollTrigger
  if (window.gsap && window.ScrollTrigger) {
    gsap.registerPlugin(ScrollTrigger);

    document.querySelectorAll(".parallax-layer").forEach(layer => {
      const speed = parseFloat(layer.dataset.parallax || "0.08");
      gsap.to(layer, {
        yPercent: speed * 100,
        ease: "none",
        scrollTrigger: {
          trigger: layer.closest(".parallax-wrap") || layer.parentElement,
          start: "top bottom",
          end: "bottom top",
          scrub: true,
        }
      });
    });

    // ویدئو/تصویر در Bands با ورود سینمایی
    document.querySelectorAll(".band-media").forEach(media=>{
      gsap.fromTo(media, {y:40, opacity:0, scale:0.98}, {
        y:0, opacity:1, scale:1,
        scrollTrigger:{trigger:media, start:"top 80%", toggleActions:"play none none reverse"},
        duration:1.2, ease:"power3.out"
      });
    });
  }
});


// Apple-like text reveal
if (window.gsap && window.ScrollTrigger) {
  document.querySelectorAll("[data-reveal]").forEach(el=>{
    const text = el.textContent.trim();
    el.textContent = "";
    const words = text.split(/\s+/);
    words.forEach((w,i)=>{
      const line=document.createElement("span");
      line.className="reveal-line";
      const inner=document.createElement("span");
      inner.textContent=w + (i<words.length-1?' ':'');
      line.appendChild(inner);
      el.appendChild(line);
    });
    gsap.to(el.querySelectorAll(".reveal-line > span"), {
      y:0, opacity:1, duration:0.9, ease:"power3.out",
      stagger:0.04,
      scrollTrigger:{trigger:el, start:"top 85%"}
    });
  });
}


// Logo motion (subtle Apple-like)
const logoEl = document.querySelector("[data-logo-motion] img");
if(logoEl && window.gsap){
  gsap.fromTo(logoEl, {scale:0.9, opacity:0, filter:"blur(14px)"},{
    scale:1, opacity:1, filter:"blur(0px)", duration:1.6, ease:"power3.out"
  });
  gsap.to(logoEl, {
    y:-8, duration:3.2, yoyo:true, repeat:-1, ease:"sine.inOut"
  });
}

// Scroll down button to next section
const scrollBtn = document.querySelector("[data-scroll-next]");
if(scrollBtn){
  scrollBtn.addEventListener("click", ()=>{
    const next = scrollBtn.closest("section")?.nextElementSibling;
    if(next) window.scrollTo({top: next.offsetTop - 80, behavior:"smooth"});
  });
}
