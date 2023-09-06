const image = document.getElementById('image')
const preview = document.getElementById('preview')

image.addEventListener("change", ()=>{
    const file = image.files[0]
    const reader = new FileReader;

    reader.addEventListener("load", ()=>{
        preview.innerHTML = ""
        const imagefile = document.createElement('img')
        imagefile.style.height = "100px"
        imagefile.style.width = "100px"
        imagefile.src = reader.result
        preview.appendChild(imagefile)
    })
    reader.readAsDataURL(file)
})