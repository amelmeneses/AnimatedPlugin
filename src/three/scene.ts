import * as THREE from 'three';
import { OrbitControls } from 'three/addons/controls/OrbitControls.js';
import { createCamera } from './camera';
import { createLights } from './lights';
import { LogoRenderer } from './logoRenderer';

export interface SceneContext {
  renderer: THREE.WebGLRenderer;
  scene: THREE.Scene;
  camera: THREE.PerspectiveCamera;
  logo: LogoRenderer;
  controls: OrbitControls | null;
}

export function initScene(
  container: HTMLElement,
  enableOrbitControls = false,
): SceneContext {
  // Remove any existing canvas (prevents duplicates)
  const existingCanvas = container.querySelector('canvas');
  if (existingCanvas) existingCanvas.remove();

  const w = container.clientWidth || 100;
  const h = container.clientHeight || 100;

  const scene = new THREE.Scene();
  const camera = createCamera(w / h);

  const renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
  renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
  renderer.setSize(w, h);
  renderer.outputColorSpace = THREE.SRGBColorSpace;
  renderer.toneMapping = THREE.ACESFilmicToneMapping;
  renderer.toneMappingExposure = 1.2;
  container.appendChild(renderer.domElement);

  scene.add(createLights());

  const logo = new LogoRenderer(scene);

  let controls: OrbitControls | null = null;
  if (enableOrbitControls) {
    controls = new OrbitControls(camera, renderer.domElement);
    controls.enableDamping = true;
    controls.dampingFactor = 0.08;
  }

  function animate() {
    requestAnimationFrame(animate);
    controls?.update();
    renderer.render(scene, camera);
  }
  animate();

  const onResize = () => {
    const cw = container.clientWidth || 100;
    const ch = container.clientHeight || 100;
    camera.aspect = cw / ch;
    camera.updateProjectionMatrix();
    renderer.setSize(cw, ch);
  };
  window.addEventListener('resize', onResize);

  return { renderer, scene, camera, logo, controls };
}
