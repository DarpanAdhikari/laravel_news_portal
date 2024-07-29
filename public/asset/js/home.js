var heading = document.getElementById('article-heading');
if(heading){
  function adjustFontSize() {
    if (heading.getBoundingClientRect().top <= 60) {
      heading.classList.add('stick');
    } else {
      heading.classList.remove('stick');
    }
  }
  window.addEventListener('scroll', adjustFontSize);  
}
 // search field script
const searchField = document.querySelector('#searchInput');
if(searchField){
  const inputField = document.querySelector('#searchInp'),
        searchItem = document.getElementById('searchItems');
  function viewAll(){
    searchFunction();
  }

  inputField.addEventListener('keyup',(e)=>{
     if(e.key === "Enter"){
      searchFunction();
     }
  });
  document.addEventListener('click',(e)=>{
    if(!searchField.contains(e.target) && !searchItem.contains(e.target)){
      searchItem.classList.add('hidden');
    }else{
      searchItem.classList.remove('hidden');
    }
  });
  function searchFunction() {
    if (inputField.value !== "" && inputField.value.trim() !== "") {
      const currentURL = window.location.href;
      const domain = new URL(currentURL).origin;
      const searchURL = `${domain}/hashtag/${inputField.value}`;
      window.open(searchURL, "_blank");
    }
  }
}

  window.onload = () => {
    let images = document.querySelectorAll('img');

    images.forEach(img => {
        let src = img.getAttribute('src');
        if (src.endsWith('.png')) {
            img.style.background = 'none';
        }
    });
};

const newsDetails = document.querySelectorAll('.news-detail');
if (newsDetails) {
  newsDetails.forEach(newsDetail => {
    const images = newsDetail.querySelectorAll('img');
    images.forEach(image => {
      image.style.display = 'none';
    });
  });
}

function convertToSlug(input) {
  return input
      .toLowerCase()
      .trim()
      .replace(/\s+/g, "-");
}
var tags = document.querySelectorAll('[data-type="tag"]');
if(tags){
  tags.forEach(tag=>{
    let slug = convertToSlug(tag.getAttribute('href'));
    tag.href = slug;
  })
}

function autoResize(textarea) {
  textarea.style.height = "auto";
  textarea.style.height = textarea.scrollHeight + "px";
}

let textareas = document.querySelectorAll('.resizable-textarea');
if (textareas) {
  textareas.forEach(textarea => {
    textarea.addEventListener('input', () => {
      autoResize(textarea);
    });
  });
}

const commentReply = document.querySelectorAll('.comment-reply');
if(commentReply){
  commentReply.forEach((reply,index)=>{
      reply.addEventListener('click',(e)=>{
          document.querySelectorAll('.reply-field')[index].classList.toggle('hidden');
          document.querySelectorAll('.chat-bubble')[index].classList.add('hidden');
      });
  });
}
document.addEventListener('click',(e)=>{
  document.querySelectorAll('.reply-field').forEach((replyInp,index)=>{
      if(!replyInp.contains(e.target) && !commentReply[index].contains(e.target)){
        document.querySelectorAll('.reply-field')[index].classList.add('hidden');
      }
  });
});

async function share(){
      const currentURL = window.location.href;
      const domain = new URL(currentURL).origin;
      const url = `${domain}/${document.querySelector('.social-share').getAttribute('data-link')}`;
  await navigator.share({
    title:document.title,
    url: url,
  })
}

document.addEventListener("DOMContentLoaded", function() {
  const shareButtons = document.querySelectorAll('.social-share .btn');

  shareButtons.forEach(button => {
      button.addEventListener('click', function(event) {
          event.preventDefault();
          const socialNetwork = button.getAttribute('href');
          shareOnSocialMedia(socialNetwork);
      });
  });

  function shareOnSocialMedia(socialNetwork) {
      const currentURL = window.location.href;
      const domain = new URL(currentURL).origin;
      const url = `${domain}/${document.querySelector('.social-share').getAttribute('data-link')}`;
      let shareLink;
      let popupWidth = 600;
      let popupHeight = 700;

      switch (socialNetwork) {
          case '#facebook':
              shareLink = 'https://www.facebook.com/sharer.php?t=' + url;
              break;
          case '#twitter':
              shareLink = 'https://twitter.com/intent/tweet?url=' + url;
              break;
          case '#dribbble':
              shareLink = 'https://dribbble.com/share?url=' + url;
              break;
          case '#linkedin':
              shareLink = 'https://www.linkedin.com/shareArticle?url=' + url;
              break;
          case '#pinterest':
              shareLink = 'https://pinterest.com/pin/create/button/?url=' + url;
              break;
          case '#email':
              shareLink = 'mailto:?subject='+document.querySelector(".article-heading").textContent.trim()+' &body=' + 'Visit this url - ' + window.location.href;
              popupWidth = 500; 
              popupHeight = 700;
              break;
          default:
              break;
      }

      if (shareLink) {
          const left = (screen.width - popupWidth) / 2;
          const top = (screen.height - popupHeight) / 2;
          const popupOptions = `width=${popupWidth},height=${popupHeight},top=${top},left=${left},scrollbars=yes,resizable=yes`;
          window.open(shareLink, '_blank', popupOptions);
      }
  }
});

const article = document.querySelector('.article-content'),
      articleLikeBtn =  document.querySelector('#post_like')
      heart = document.querySelector('#heart'),
      liked = document.querySelector('#liked');
if(article && articleLikeBtn){
  article.addEventListener('dblclick',(e)=>{
    articleLikeBtn.click();
    heart.classList.add('active');
    if(articleLikeBtn.classList.contains('liked')){
      liked.classList.remove('liked');
      liked.classList.add('disliked');
    }else{
      liked.classList.remove('disliked');
      liked.classList.add('liked');
    }
    setTimeout(()=>{
      document.querySelector('#heart').classList.remove('active');
    },1000)
  });
}

const likedBtn = document.getElementById('LikedBtn'),
      commented = document.getElementById('commentedBtn'),
      MostLiked = document.getElementById('most-liked'),
      MostCommented =  document.getElementById('most-commented');
if(likedBtn && MostCommented){
  likedBtn.onclick=()=>{
    MostLiked.classList.remove('hidden');
    MostCommented.classList.add('hidden');
  }
  commented.onclick=()=>{
    MostLiked.classList.add('hidden');
    MostCommented.classList.remove('hidden');
  }
}

const subscribeModal = document.querySelector('#subscribe-modal');
const subscribeBtn = document.getElementById('subscribe');

if (subscribeModal) {
    const isSubscribed = subscribeModal.classList.contains('subscribed');

    function showSubscribeModel() {
        subscribeModal.classList.remove('hidden');
        document.body.classList.add('stopOverflow');
    }

    const lastClosedTime = localStorage.getItem('subscribeClosedTime');
    if (!isSubscribed &&(!lastClosedTime || Date.now() - lastClosedTime > 24 * 60 * 60 * 1000)) {
        setTimeout(showSubscribeModel, 20000);
    }

    subscribeBtn.addEventListener('click', (e) => {
        showSubscribeModel();
    });

    document.addEventListener('click', (e) => {
        let dialogueBox = document.getElementById('subscribe-box');
        if (!subscribeBtn.contains(e.target) && !dialogueBox.contains(e.target)) {
            subscribeModal.classList.add('hidden');
            removeOverflow();
            localStorage.setItem('subscribeClosedTime', Date.now());
        }
    });
}


function removeOverflow(){
  document.body.classList.remove('stopOverflow');
}
