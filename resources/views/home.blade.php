@extends('layouts.app')

@section('title', 'Home - PneumoFusion')

@push('styles')
<style>
.content-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    width: 100%;
    max-width: 1300px;
    margin: 0 auto;
    align-items: center;
}

.model-container {
    height: 400px;
    border-radius: 20px;
    overflow: hidden;
}

#canvas3d {
    width: 100%;
    height: 100%;
}

.right-content {
    display: flex;
    flex-direction: column;
    gap: 30px;
}

.welcome-text {
    font-size: 2.5rem;
    font-weight: 700;
    line-height: 1.3;
    color: var(--text);
}

.try-button {
    padding: 16px 45px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white !important;
    text-decoration: none;
    border-radius: 50px;
    font-size: 1.1rem;
    font-weight: 600;
    transition: 0.3s ease;
    box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
    width: fit-content;
}

.try-button:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 30px rgba(102, 126, 234, 0.6);
}

.try-button::after {
    display: none !important;
}

@media (max-width: 1024px) {
    .content-grid {
        grid-template-columns: 1fr;
        gap: 40px;
    }

    .model-container {
        height: 350px;
        order: 1;
    }

    .right-content {
        order: 2;
        text-align: center;
        align-items: center;
    }

    .welcome-text {
        font-size: 2rem;
    }
}

@media (max-width: 768px) {
    .model-container {
        height: 300px;
    }

    .welcome-text {
        font-size: 1.6rem;
    }

    .try-button {
        width: 100%;
        text-align: center;
    }
}
</style>
@endpush

@section('content')
<div class="content-grid">
    <!-- LEFT: 3D MODEL -->
    <div class="model-container">
        <canvas id="canvas3d"></canvas>
    </div>

    <!-- RIGHT: TEXT -->
    <div class="right-content">
        <h2 class="welcome-text">
            Welcome to PneumoFusion<br>
            Your AI-Powered Lung Health Companion
        </h2>

        @auth
            <a href="{{ route('results') }}" class="try-button">
                Try Now →
            </a>
        @else
            <a href="{{ route('register') }}" class="try-button">
                Try Now →
            </a>
        @endauth
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/three@0.128.0/examples/js/loaders/GLTFLoader.js"></script>
<script>
let scene, camera, renderer, lung, autoRotate = true;

function init3D() {
    const container = document.getElementById('canvas3d');
    scene = new THREE.Scene();
    
    camera = new THREE.PerspectiveCamera(45, container.clientWidth / container.clientHeight, 0.1, 1000);
    camera.position.z = 4;
    
    renderer = new THREE.WebGLRenderer({ canvas: container, alpha: true, antialias: true });
    renderer.setSize(container.clientWidth, container.clientHeight);
    renderer.setClearColor(0x000000, 0);
    
    const ambientLight = new THREE.AmbientLight(0xffffff, 0.7);
    scene.add(ambientLight);
    
    const directionalLight = new THREE.DirectionalLight(0xffffff, 0.6);
    directionalLight.position.set(5, 5, 5);
    scene.add(directionalLight);
    
    const loader = new THREE.GLTFLoader();
    loader.load('/models/lung2.glb',
        (gltf) => {
            lung = gltf.scene;
            lung.scale.set(2, 2, 2);
            scene.add(lung);
        },
        undefined,
        (error) => {
            const geometry = new THREE.TorusKnotGeometry(1, 0.3, 100, 16);
            const material = new THREE.MeshPhongMaterial({ color: 0x667eea, transparent: true, opacity: 0.9 });
            lung = new THREE.Mesh(geometry, material);
            scene.add(lung);
        }
    );
    
    let isDragging = false, prevMouse = { x: 0, y: 0 };
    
    container.addEventListener('mousedown', (e) => {
        isDragging = true;
        autoRotate = false;
        prevMouse = { x: e.offsetX, y: e.offsetY };
    });
    
    container.addEventListener('mouseup', () => isDragging = false);
    container.addEventListener('mouseleave', () => isDragging = false);
    
    container.addEventListener('mousemove', (e) => {
        if (isDragging && lung) {
            lung.rotation.y += (e.offsetX - prevMouse.x) * 0.01;
            lung.rotation.x += (e.offsetY - prevMouse.y) * 0.01;
            prevMouse = { x: e.offsetX, y: e.offsetY };
        }
    });
    
    window.addEventListener('resize', () => {
        camera.aspect = container.clientWidth / container.clientHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(container.clientWidth, container.clientHeight);
    });
    
    animate();
}

function animate() {
    requestAnimationFrame(animate);
    if (lung && autoRotate) lung.rotation.y += 0.005;
    renderer.render(scene, camera);
}

window.addEventListener('load', init3D);
</script>
@endpush