function showImage(file) {
    let getFile = document.getElementById("showGambar");
    $("#showGambar").show();

    getFile.src = window.URL.createObjectURL(file);
}
