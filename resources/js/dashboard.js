const menuBar = document.querySelector(".content nav .bx.bx-menu");
const sideBar = document.querySelector(".sidebar");

menuBar.addEventListener("click", () => {
    sideBar.classList.toggle("close");
});
window.addEventListener('resize',()=>{
    resizeSideBar();
});
function resizeSideBar(){
if (window.innerWidth < 800) {
    sideBar.classList.add("close");
}
}
resizeSideBar();

const searchBtn = document.querySelector('.content .top-nav .search-items .form-inputs button'),
      searchInput = document.querySelector('.content .top-nav .search-items');
searchBtn.addEventListener('click',()=>{
  searchInput.classList.toggle('show');
});

const toggler = document.getElementById("theme-toggle");

toggler.addEventListener("change", function () {
    if (this.checked) {
        document.documentElement.classList.add("dark");
        localStorage.setItem("Dark-Mode", "Dark");
    } else {
        document.documentElement.classList.remove("dark");
        localStorage.removeItem("Dark-Mode");
    }
});

function checkDarkMode() {
    if (localStorage.getItem("Dark-Mode") == "Dark") {
        document.documentElement.classList.add("dark");
        toggler.checked = true;
    } else {
        document.documentElement.classList.remove("dark");
    }
}
checkDarkMode();

function autoResize(textarea) {
    textarea.style.height = "auto";
    textarea.style.height = textarea.scrollHeight + "px";
}

  let resiteTexArea = document.querySelectorAll('.resizable-textarea');
  if (resiteTexArea) {
    resiteTexArea.forEach(textarea => {
      textarea.addEventListener('input', () => {
        autoResize(textarea);
      });
    });
  }

function isValidJson(jsonString) {
    try {
        JSON.parse(jsonString);
        return { valid: true };
    } catch (e) {
        return { valid: false, error: e.message };
    }
}

var textareas = document.querySelectorAll(".json-data");
if (textareas) {
    window.addEventListener('load',(e)=>{
         textareas.forEach(text=>{
            let value = text.value;
            const newText = value.replace(/",\s*/g, '",\n\n\t\t').replace(/\],\s*/g, '],\n\n\n\t');
            text.value = newText;

            autoResize(text);
         });
    });

    textareas.forEach(function (textarea) {
        textarea.addEventListener("input", function (e) {
            var value = textarea.value;
            var result = isValidJson(value);
            if (result.valid) {
                textarea.style.border = "4px solid green";
            } else {
                textarea.style.border = "4px solid red";
            }
        });

        textarea.closest("form").addEventListener("submit", function (event) {
            var value = textarea.value;
            var result = isValidJson(value);
            if (!result.valid) {
                event.preventDefault();
                alert(result.error);
            }
        });
    });
}

const fileInputs = document.querySelectorAll('input[type="file"]');
if(fileInputs){
    fileInputs.forEach((input,index) => {
        input.addEventListener("change", function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (event) {
                    const previewImage = document.querySelectorAll(".image-preview")[index];
                    if(previewImage){
                        previewImage.src = event.target.result;
                    }
                };
                reader.readAsDataURL(file);
            }
        });
    });
}

const switchButton = document.querySelector("#switchSlug"),
    attached = document.getElementById("attached"),
    notAttached = document.getElementById("not-attached");
if (attached && notAttached) {
    switchButton.addEventListener("click", () => {
        contentPostForm();
    });
    function contentPostForm() {
        if (switchButton.checked) {
            attached.classList.remove("hidden");
            notAttached.classList.add("hidden");
            document
                .getElementById("nepali-featureImg")
                .classList.add("hidden");
        } else {
            attached.classList.add("hidden");
            notAttached.classList.remove("hidden");
            document
                .getElementById("nepali-featureImg")
                .classList.remove("hidden");
        }
    }
    contentPostForm();
}

function convertToSlug(input) {
    return input
        .toLowerCase()
        .replace(/\s+/g, "-")
        .replace(/[^a-z0-9-]/g, "");
}
var slugFields = document.querySelectorAll("input.slug-field");

if (slugFields) {
    var englishRegex = /^[A-Za-z\s]+$/;
    var slugRegex = /^[a-z0-9]+(?:-[a-z0-9]+)*$/;

    slugFields.forEach(function (inputField) {
        inputField.addEventListener("input", function () {
            let inputEach = inputField.value.trim();
            if (inputEach !== "" && inputField.value !== "") {
                if(inputEach[0] === "-"){
                    inputField.value = "";
                }
                var slug = convertToSlug(inputField.value);
                inputField.value = slug;
            }
        });
        inputField.addEventListener("blur", function () {
            let inputEach = inputField.value.trim();
            if(inputEach[0] === "-"){
                inputField.value = "";
            }
        });
    });
}

const forms = document.querySelectorAll('form');
if(forms){
    forms.forEach(form=>{
        document.addEventListener("keydown", function(event) {
            if ((event.ctrlKey || event.metaKey) && event.key === "s") {
                event.preventDefault();
                const hasTextarea = form.querySelector('textarea') !== null;
                if(hasTextarea){
                    if (confirm("Are you sure you want to submit"+form.getAttribute('action')+"form?")) {
                        form.submit();
                    }
                }
            }
        });
    });    
}

const tableSearch = document.getElementById("table-search");
const tables = document.querySelectorAll('tbody');
if (tableSearch && tables) {
    tableSearch.addEventListener("input", function() {
        var filter = tableSearch.value.toUpperCase().trim();
        if(filter == ''){
            return;
        }
        for (var k = 0; k < tables.length; k++) {
            var trs = tables[k].getElementsByTagName("tr");
            for (var i = 0; i < trs.length; i++) {
                var tds = trs[i].getElementsByTagName("td");
                var rowMatched = false;
                for (var j = 0; j < tds.length; j++) {
                    highlightTextNodes(tds[j], filter);
                    var txtValue = tds[j].textContent || tds[j].innerText;
                    rowMatched = rowMatched || txtValue.toUpperCase().includes(filter);
                }
                trs[i].style.display = rowMatched ? "" : "none";
            }
        }
    });
}

function highlightTextNodes(element, filter) {
    if (element.nodeType === Node.TEXT_NODE) {
        var txtValue = element.nodeValue || element.textContent;
        var index = txtValue.toUpperCase().indexOf(filter);
        if (index > -1) {
            var preText = document.createTextNode(txtValue.substr(0, index)); 
            var matchText = document.createElement('span');
            matchText.className = 'highlight-search';
            matchText.textContent = txtValue.substr(index, filter.length);
            var postText = document.createTextNode(txtValue.substr(index + filter.length));
            element.parentNode.insertBefore(preText, element);
            element.parentNode.insertBefore(matchText, element); 
            element.parentNode.insertBefore(postText, element); 
            element.parentNode.removeChild(element); 
        }
    } else if (element.nodeType === Node.ELEMENT_NODE) {
        var childNodes = Array.from(element.childNodes); 
        childNodes.forEach(function(node) {
            highlightTextNodes(node, filter);
        });
    }
}

const addElementBtn = document.getElementById('addElementBtn'),
            customElement = document.getElementById('custom-element'),
            elementsContainer = document.querySelector('#elements'),
            copyBtn = document.querySelector('#copy-code');

if(addElementBtn && elementsContainer && customElement){
    addElementBtn.addEventListener('click', function() {
        let element = customElement.textContent.trim();
        var newElement = document.createElement('div');
        newElement.innerHTML = element;
        newElement.classList.add('element');
        newElement.classList.add('cursor-pointer');
        elementsContainer.appendChild(newElement);
        customElement.textContent = '';
        newElement.addEventListener('click', function() {
            elementsContainer.removeChild(newElement);
        });
    });

    copyBtn.addEventListener('click', function() {
        let content = document.querySelector('#editor').textContent.trim();
        navigator.clipboard.writeText(content);
    });
}