if (typeof scrollMe === 'undefined') {
    const scrollMe = document.querySelectorAll('.scroll-down');
    if (scrollMe) {
        scrollMe.forEach(function(element) {
            element.scrollTop = element.scrollHeight;
        });
    }
}

// document.addEventListener('DOMContentLoaded', function () {
//     const searchInput = document.getElementById('userSearch');
//     const userItems = document.querySelectorAll('.user-item');
//     if(searchInput && userItems){
//         searchInput.addEventListener('input', function () {
//         const searchTerm = searchInput.value.trim().toLowerCase();
//         userItems.forEach(function (item) {
//             const userName = item.querySelector('.user_info span').textContent.toLowerCase();
//             if (userName.includes(searchTerm)) {
//                 item.style.display = 'block';
//             } else {
//                 item.style.display = 'none';
//             }
//         });
//     });
//     }
// });

const userToggle = document.querySelector('#user-toggle'),
      userNav = document.querySelector('#userNav');
if(userToggle && userNav){
    userToggle.addEventListener('click',()=>{
        userNav.classList.remove('max-md:hidden');
    });
    document.addEventListener('click',(e)=>{
      if(!userToggle.contains(e.target) && !userNav.contains(e.target)){
        userNav.classList.add('max-md:hidden');
      }
    });
}

// document.getElementById('uploadBtn').addEventListener('click', function() {
//     document.getElementById('fileInput').click();
// });
// document.querySelector('#messageForm').addEventListener('submit',()=>{
//     const imageItems = document.querySelectorAll('.image-item');
//     if(imageItems){
//         imageItems.forEach(item => {
//             item.remove();
//         });
//     }
// });
// document.getElementById('fileInput').addEventListener('change', function() {
//     const files = Array.from(this.files);
//     files.forEach(file => {
//         const reader = new FileReader();
//         reader.onload = function(e) {
//             const imageContainer = document.createElement('div');
//             imageContainer.classList.add('image-item');
//             const image = document.createElement('img');
//             image.src = e.target.result;
//             image.classList.add('img-thumbnail');
//             const closeButton = document.createElement('span');
//             closeButton.classList.add('close-btn');
//             closeButton.innerHTML = '&times;';
//             closeButton.addEventListener('click', function() {
//                 const index = Array.from(imageContainer.parentElement.children).indexOf(imageContainer);
//                 imageContainer.remove();
//                 files.splice(index, 1);
//             });

//             imageContainer.appendChild(image);
//             imageContainer.appendChild(closeButton);
//             document.getElementById('imageContainer').appendChild(imageContainer);
//         }

//         reader.readAsDataURL(file);
//     });
// });