var infoBox = document.getElementById('info-box');
document.getElementById('info-button').addEventListener('click', function () {
    if (infoBox.style.display === 'none' || infoBox.style.display === '') {
      infoBox.style.display = 'block';
    }
  });

document.getElementById('close_button').addEventListener('click', function (){
  if (infoBox.style.display === 'block') {
    infoBox.style.display = 'none';
  }

})