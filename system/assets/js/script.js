function fileHandler(input) {
    if(input.files && input.files[0])
    {
        var reader = new FileReader(),
            file = input.files[0];

        reader.onload = function (e) {
            namePreview.value = file.name;
            imagePreview.src = e.target.result;
            clearInput.addEventListener('click', clearHandler);
            clearInput.style.display = 'inline-block';
            browseBtn.style.width = '59%';
        };

        reader.readAsDataURL(file);
    }
    else clearHandler(false);
}

function clearHandler(e) {

    fileInput = document.getElementById(this.getAttribute('filetarget'));
    imagePreview = document.querySelector('img.upload-preview.'+this.getAttribute('filetarget'));
    namePreview = document.querySelector('input.upload-name.'+this.getAttribute('filetarget'));
    clearInput = document.querySelector('button.file-clear.'+this.getAttribute('filetarget'));
    browseBtn = document.querySelector('label.file-input.'+this.getAttribute('filetarget'));

    fileInput.value = '';
    namePreview.value = '';
    imagePreview.src = imagePreview.getAttribute('defaultpreview');
    this.style.display = 'none';
    browseBtn.style.width = '100%';
    if(e)
    {
        clearInput.removeEventListener('click', clearHandler);
    }

}