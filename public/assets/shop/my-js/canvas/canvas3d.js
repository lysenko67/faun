(function () {
    const canvas = document.querySelector('#c')
    const resizeCanvas = document.getElementById('resizeCanvas')
    const hideBlock = document.querySelectorAll('.hide-block')
    const myCanvas = document.querySelectorAll('.myCanvas')
    const content = document.getElementById('content')
    const glrfFile = canvas.getAttribute('data-gltf')
    const canvasCenter = document.getElementById('canvas-center')


    const loadCanvas = document.querySelectorAll('.load-canvas')
    THREE.DefaultLoadingManager.onLoad = function () {
        loadCanvas.forEach(item => {
            item.classList.add('hide')
        })
    };

    canvas.addEventListener('mousedown', function () {
        canvas.style.cursor = 'grabbing'
    })
    canvas.addEventListener('mouseup', function () {
        canvas.style.cursor = 'grab'
    })
    resizeCanvas.addEventListener('click', function () {
        canvas.style.zIndex = '1000'

        myCanvas.forEach(canvas => {
            canvas.classList.toggle('full-scrin')
        })

        hideBlock.forEach(item => {
            item.classList.toggle('hide')
        })

        content.classList.toggle('content-top')

        canvasCenter.classList.toggle('d-flex')
        canvasCenter.classList.toggle('justify-content-center')
        canvasCenter.classList.toggle('col-7')
    })

    const renderer = new THREE.WebGLRenderer({
        canvas: canvas,
        antialias: true // сглаживание
    })

    const scene = new THREE.Scene()
    // scene.add(new THREE.AxesHelper(5)) // показать координаты

    const camera = new THREE.PerspectiveCamera(15, 1, 1, 1000)
    camera.position.z = 24

    {
        const directionalLight = new THREE.DirectionalLight(0xFFFFFF, 1)
        directionalLight.position.set(5, 8, 10)
        scene.add(directionalLight)

        const hemisphereLight = new THREE.HemisphereLight(0xB1E1FF, 0xB97A20, 1)
        scene.add(hemisphereLight)
    }

    const controls = new THREE.OrbitControls(camera, renderer.domElement)
    controls.enableDamping = true //плавное перемещение
    // controls.dampingFactor = 0.2;
    controls.minDistance = 2 // минимальная дистанция до камеры
    controls.zoomSpeed = 2 // скорость наезда камеры

    const gltfLoader = new THREE.GLTFLoader()
    gltfLoader.load(
        glrfFile,
        (gltf) => {
            const root = gltf.scene
            scene.add(root)
        }
    )

    function animate() {
        requestAnimationFrame(animate)
        controls.update()
        renderer.render(scene, camera)
    }

    function loadScene() {
        if (camera.position.z > 7) {
            camera.position.z += -0.2
            camera.position.x += -0.03
            requestAnimationFrame(loadScene)
        } else {
            return
        }
    }
    loadScene()
    animate()
})()
