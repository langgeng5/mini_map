window.addEventListener('load', () => {
    const canvas = document.querySelector('canvas')
    const c = canvas.getContext('2d')
    const saveBtn = document.querySelector('#save')

    saveBtn.addEventListener('click', function(){
        if(window.navigator.msSaveBlob){
            window.navigator.msSaveBlob(canvas.msToBlob(), "canvas-image.png")
        }else{
            const a = document.createElement("a")

            document.body.appendChild(a)
            a.href = canvas.toDataURL("image/hpeg")
            a.download = "canvas-image.jpg"
            a.click()

            document.body.removeChild(a)
        }
    })

    //resizing
    canvas.height = window.innerHeight
    canvas.width = window.innerWidth

    //variables
    let painting = false

    function startPosition(e){
        painting = true
        draw(e)
    }

    function finishPosition(){
        painting = false
        c.beginPath()
    }

    function getMousePos(event){
        var rect = canvas.getBoundingClientRect()

        return {
            x: event.clientX - rect.left,
            y: event.clientY - rect.top
        }
    }

    function draw(event){
        if(!painting) return
        c.lineWidth = 10
        c.lineCap = "round"
        c.strokeStyle = 'red'

        mousePos = getMousePos(event)

        c.lineTo(mousePos.x, mousePos.y)
        c.stroke()
        c.beginPath()
        c.lineTo(mousePos.x, mousePos.y)
    }

    //eventListeners
    canvas.addEventListener('mousedown', startPosition)
    canvas.addEventListener('mouseup', finishPosition)
    canvas.addEventListener('mousemove', draw)
})