var redbrick_images = document.querySelectorAll("img");
for (var i = 0; i < redbrick_images.length; i++) {
    redbrick_images[i].removeAttribute("srcset");
}