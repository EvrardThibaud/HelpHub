document.addEventListener('DOMContentLoaded', function () {
    const savePreferencesCheckbox = document.getElementById('savePreferences');
    const preferencesOptions = document.getElementById('preferencesOptions');
    const thirdPartyAdsCheckbox = document.getElementById('thirdPartyAds');
    const thirdPartyOptions = document.getElementById('thirdPartyOptions');

    savePreferencesCheckbox.addEventListener('change', function () {
        preferencesOptions.style.display = savePreferencesCheckbox.checked ? 'block' : 'none';
    });

    thirdPartyAdsCheckbox.addEventListener('change', function () {
        thirdPartyOptions.style.display = thirdPartyAdsCheckbox.checked ? 'block' : 'none';
    });
});

function goBack() {
    window.history.back();
}
