import * as THREE from 'three';

export function createLights(): THREE.Group {
  const group = new THREE.Group();

  // Strong ambient for bright white logo
  const ambient = new THREE.AmbientLight(0xffffff, 0.8);
  group.add(ambient);

  // Key light — front
  const key = new THREE.DirectionalLight(0xffffff, 1.8);
  key.position.set(2, 3, 5);
  group.add(key);

  // Fill light — left
  const fill = new THREE.DirectionalLight(0xffffff, 0.8);
  fill.position.set(-4, 2, 3);
  group.add(fill);

  // Rim / back light
  const rim = new THREE.DirectionalLight(0xffffff, 0.6);
  rim.position.set(0, -2, -4);
  group.add(rim);

  return group;
}
