/* PetSaathi auth UI enhancements.
   Progressive enhancement only - forms post normally to Laravel, nothing here
   calls preventDefault, so validation and auth stay entirely server-side. */
(function () {
  function initTogglePass() {
    document.querySelectorAll('.toggle-pass').forEach(function (btn) {
      btn.addEventListener('click', function () {
        var target = document.getElementById(btn.dataset.target);
        if (!target) return;
        var show = target.type === 'password';
        target.type = show ? 'text' : 'password';
        btn.textContent = show ? '🙈' : '👁️';
        btn.setAttribute('aria-label', show ? 'Hide password' : 'Show password');
      });
    });
  }

  function score(value) {
    if (value.length < 8) return value.length === 0 ? 0 : 1;
    var variety = 0;
    if (/[a-z]/.test(value)) variety++;
    if (/[A-Z]/.test(value)) variety++;
    if (/\d/.test(value)) variety++;
    if (/[^A-Za-z0-9]/.test(value)) variety++;
    if (variety >= 3 && value.length >= 12) return 3;
    if (variety >= 2) return 2;
    return 1;
  }

  function initStrengthMeter() {
    document.querySelectorAll('[data-strength-for]').forEach(function (meter) {
      var input = document.getElementById(meter.dataset.strengthFor);
      if (!input) return;
      var bars = meter.querySelectorAll('span');
      input.addEventListener('input', function () {
        var s = score(input.value);
        meter.dataset.level = s;
        bars.forEach(function (bar, i) {
          bar.classList.toggle('on', i < s);
        });
      });
    });
  }

  document.addEventListener('DOMContentLoaded', function () {
    initTogglePass();
    initStrengthMeter();
  });
})();
