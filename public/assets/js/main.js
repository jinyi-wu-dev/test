import * as THREE from 'three';
import { STLLoader } from 'three/addons/loaders/STLLoader.js';
import { OrbitControls } from 'three/addons/controls/OrbitControls.js';

let container, targetObject;
let camera, scene, renderer;
let isLeftMouseDown = false;
let isRightMouseDown = false;
let controls;
init();

function init() {
    // container = document.createElement('div');
    // document.body.appendChild(container);
    const container = document.getElementById('canvasBox');
    const stlPath = container.dataset.stlPath || '';
    camera = new THREE.PerspectiveCamera(45, window.innerWidth / window.innerHeight, 1, 10000);
    camera.lookAt(new THREE.Vector3(0, 0, 0));
    camera.position.set(0, 0, 0);

    scene = new THREE.Scene();
    scene.background = new THREE.Color(0xFFFFFF);

    const material = new THREE.MeshPhongMaterial({ color: 0xd5d5d5, specular: 0x494949, shininess: 200 });
    const loader = new STLLoader();
    loader.load(stlPath, function (geometry) {
        let meshMaterial = material;

        if (geometry.hasColors) {
            newMaterial = new THREE.MeshPhongMaterial({ opacity: geometry.alpha, vertexColors: true });
        }

        const mesh = new THREE.Mesh(geometry, meshMaterial);

        // オブジェクトの縦横高さを取得
        let box3 = new THREE.Box3().setFromObject(mesh);
        let size = new THREE.Vector3();
        box3.getSize(size);

        geometry.center();
        mesh.position.set(0, 0, 0);
        mesh.castShadow = true;
        mesh.receiveShadow = true;


        scene.add(mesh);

        // camera setting
        camera.position.set(0, 0, size.z * 2);

        targetObject = mesh;
    });

    // Lights
    const hemiLight = new THREE.HemisphereLight(0xffffff, 0x909090, 3);
    hemiLight.position.set(0, 20, 0);
    scene.add(hemiLight);

    const directionalLight = new THREE.DirectionalLight(0xffffff, 1);
    directionalLight.position.set(10, 10, 10).normalize();
    scene.add(directionalLight);

    // renderer
    renderer = new THREE.WebGLRenderer({ antialias: true });
    renderer.setPixelRatio(window.devicePixelRatio);
    renderer.setSize(window.innerWidth, window.innerHeight);
    renderer.setAnimationLoop(animate);
    renderer.shadowMap.enabled = true;

    container.appendChild(renderer.domElement);


    controls = new OrbitControls(camera, renderer.domElement);
    controls.enableDamping = true; // なめらかな動き
    controls.dampingFactor = 0.05;
    

    // アニメーションループ内で更新
    renderer.setAnimationLoop(() => {
        controls.update(); // これを呼ぶの忘れずに
        render();
    });
    // window.addEventListener('resize', onWindowResize);
    // window.addEventListener('mousedown', onMouseDown);
    // window.addEventListener('mousemove', onMouseMove);
    // window.addEventListener('mouseup', onMouseUp);
    // window.addEventListener('mousewheel', onMouseWheel);
}

function animate() {
    render();
}


function onWindowResize() {
    const width = container.clientWidth;
    const height = container.clientHeight;
  
    camera.aspect = width / height;
    camera.updateProjectionMatrix();
  
    renderer.setSize(width, height);
  }
  

function onMouseDown(event) {
    if (event.button === 0) {
        isLeftMouseDown = true;
    } else if (event.button === 2) {
        isRightMouseDown = true;
    }
}

function onMouseMove(event) {
    // 左クリックしながらであれば、マウスの移動量に応じてtargetObjectの中心を軸に回転させる
    if (isLeftMouseDown) {
        let x = event.movementX;
        let y = event.movementY;
        targetObject.rotation.y += x * 0.01;
        targetObject.rotation.x += y * 0.01;
    } else if (isRightMouseDown) {
        let x = event.movementX;
        let y = event.movementY;
        targetObject.position.x += x * 0.1;
        targetObject.position.y -= y * 0.1;
    }
}

function onMouseWheel(event) {
    // マウスホイールで拡大縮小
    let delta = event.wheelDelta;
    console.log(delta, targetObject.scale.x);
    if (delta > 0 && targetObject.scale.x < 5) {
        targetObject.scale.x += delta * 0.001;
        targetObject.scale.y += delta * 0.001;
        targetObject.scale.z += delta * 0.001;
    } else if (delta < 0 && targetObject.scale.x > 0.2) {
        targetObject.scale.x += delta * 0.001;
        targetObject.scale.y += delta * 0.001;
        targetObject.scale.z += delta * 0.001;
    }
}

function onMouseUp(event) {
    // マウスアップしたのが左か右かを取得
    if (event.button === 0) {
        isLeftMouseDown = false;
    } else if (event.button === 2) {
        isRightMouseDown = false;
    }
}

function render() {
    renderer.render(scene, camera);
}