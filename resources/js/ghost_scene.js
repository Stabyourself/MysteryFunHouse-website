import * as THREE from 'three';
import { GLTFLoader } from 'three/addons/loaders/GLTFLoader.js';

function createGhostScene(el, onLoad) {
  const width = el.clientWidth;
  const height = el.clientHeight;

  const scene = new THREE.Scene();
  const camera = new THREE.PerspectiveCamera(20, width / height, 0.1, 1000);
  const boom = new THREE.Group();
  scene.add(boom);
  boom.add(camera);
  boom.position.set(0, 0.9, 0)
  camera.position.set(0, 0, -6)
  camera.lookAt(0, 0.9, 0);

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
  let mixer;

  loader.load('/model/ghost_and_logo.glb', function (glb) {
    megaghost = glb.scene;
    scene.add(megaghost);
    megaghost.position.set(1.3, 0, 0)

    // play armature animation
    mixer = new THREE.AnimationMixer();
    let clip = mixer.clipAction(glb.animations[0], glb.scene);
    clip.play();

    mixer.update(1)

    if (onLoad) onLoad();
  })

  const ambientLight = new THREE.AmbientLight(0xFFFFFF);
  ambientLight.intensity = 1;
  scene.add(ambientLight);

  for (let i = 0; i < 10; i++) {
    let pointLight = new THREE.PointLight(0xebfeff, 1);
    pointLight.position.set(Math.random() * 10 - 5, Math.random() * 5, Math.random() * 10 - 5);
    scene.add(pointLight)
  }
  let directionallight = new THREE.DirectionalLight(0xebfeff, Math.PI)
  directionallight.position.set(2, 0.1, 1)
  directionallight.visible = true
  scene.add(directionallight)

  directionallight = new THREE.DirectionalLight(0xebfeff, Math.PI)
  directionallight.position.set(4, 8, 0)
  directionallight.visible = true
  scene.add(directionallight)

  directionallight = new THREE.DirectionalLight(0xebfeff, Math.PI)
  directionallight.position.set(-4, 1, 0)
  directionallight.visible = true
  scene.add(directionallight)

  directionallight = new THREE.DirectionalLight(0xebfeff, Math.PI)
  directionallight.position.set(0, 1, -1)
  directionallight.visible = true
  scene.add(directionallight)


  renderer.setAnimationLoop(animate);
  el.appendChild(renderer.domElement);

  let tiltX = 0;
  let tiltY = 0;

  let tiltXlerped = 0;
  let tiltYlerped = 0;

  function tilt(x, y) {
    tiltX = x;
    tiltY = y;
  }

  document.addEventListener('mousemove', (event) => {
    tilt((event.clientX / window.innerWidth) * 2 - 1, -(event.clientY / window.innerHeight) * 2 + 1)
  })

  if (window.DeviceOrientationEvent) {
    window.addEventListener("deviceorientation", function (event) {
      tilt([event.beta, event.gamma]);
    }, true);
  } else if (window.DeviceMotionEvent) {
    window.addEventListener('devicemotion', function (event) {
      tilt([event.acceleration.x * 2, event.acceleration.y * 2]);
    }, true);
  } else {
    window.addEventListener("MozOrientation", function (event) {
      tilt([orientation.x * 50, orientation.y * 50]);
    }, true);
  }

  function animate(time) {
    tiltXlerped += (tiltX - tiltXlerped) * 0.1
    tiltYlerped += (tiltY - tiltYlerped) * 0.1

    if (megaghost) {
      boom.rotation.x = -tiltYlerped * 0.4
      boom.rotation.y = -tiltXlerped * 0.4
    }

    renderer.render(scene, camera);
  }
}

export default createGhostScene;