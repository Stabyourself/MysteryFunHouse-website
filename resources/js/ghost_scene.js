import * as THREE from 'three';
import { GLTFLoader } from 'three/addons/loaders/GLTFLoader.js';

const el = document.getElementById("ghost-scene-container")
const width = el.clientWidth;
const height = el.clientHeight;

const scene = new THREE.Scene();
const camera = new THREE.PerspectiveCamera(50, width / height, 0.1, 1000);

const renderer = new THREE.WebGLRenderer({ alpha: true, antialias: true });
renderer.setPixelRatio(window.devicePixelRatio)
renderer.setSize(width, height);


renderer.outputColorSpace = THREE.SRGBColorSpace; // Or .outputEncoding for older
renderer.toneMapping = THREE.ACESFilmicToneMapping; // Film look
renderer.toneMappingExposure = 1.0;
renderer.shadowMap.enabled = true;
renderer.shadowMap.type = THREE.PCFSoftShadowMap; // Softer shadows
renderer.useLegacyLights = false; // Physically correct lights


const loader = new GLTFLoader();
let megaghost;

loader.load('/model/GHOST_unfinished.glb', function (gltf) {
  megaghost = gltf.scene;
  scene.add(megaghost);
})

camera.position.set(1.65, 1.54, -1.42);
camera.rotation.set(THREE.MathUtils.degToRad(-156), THREE.MathUtils.degToRad(48), THREE.MathUtils.degToRad(161));

const ambientLight = new THREE.AmbientLight(0xFFFFFF);
ambientLight.intensity = 1;
scene.add(ambientLight);

let directionallight = new THREE.DirectionalLight(0xebfeff, Math.PI)
directionallight.position.set(2, 0.1, 1)
directionallight.visible = true
scene.add(directionallight)

directionallight = new THREE.DirectionalLight(0xebfeff, Math.PI)
directionallight.position.set(4, 8, 0)
directionallight.visible = true
scene.add(directionallight)


renderer.setAnimationLoop(animate);
el.appendChild(renderer.domElement);

function animate(time) {
  if (megaghost) {
    megaghost.rotation.y = time / 2000;
  }

  renderer.render(scene, camera);
}

console.log("!")