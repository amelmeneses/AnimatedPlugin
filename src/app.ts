import { initScene, type SceneContext } from './three/scene';
import { latLngToRotation } from './geo/geoToRotation';
import { fetchUserLocation, presetLocations } from './geo/geoConfig';
import { updateHeaderInfo } from './ui/headerInfo';
import { renderLocationsList } from './ui/locationsList';
import { initMenu } from './ui/menu';
import { initState, setState, subscribe } from './ui/state';
import type { GeoLocation } from './geo/geoTypes';

const DEBUG_ORBIT = false;

let headerScene: SceneContext;
let widgetRoot: HTMLElement;

const locationScenes = new Map<number, SceneContext>();

export async function startApp(root: HTMLElement): Promise<void> {
  widgetRoot = root;

  // ── Detect user location by IP ──
  const userLocation = await fetchUserLocation();

  // ── State ──
  initState(userLocation);

  // ── Navbar 3D Logo ──
  const headerCanvas = root.querySelector('#header-canvas') as HTMLElement;
  headerScene = initScene(headerCanvas, DEBUG_ORBIT);
  await headerScene.logo.load();

  const initRot = latLngToRotation(userLocation.lat, userLocation.lng);
  headerScene.logo.setRotation(initRot);

  // ── Header Info ──
  updateHeaderInfo(userLocation);

  // ── Locations List ──
  const locContainer = root.querySelector('#locations-list') as HTMLElement;
  renderLocationsList(locContainer, presetLocations, onLocationSelect);

  // ── Hamburger Menu ──
  initMenu(root);

  // ── State subscriber ──
  subscribe((state) => {
    updateHeaderInfo(state.activeLocation);
  });
}

async function onLocationSelect(loc: GeoLocation, index: number): Promise<void> {
  setState({ mode: 'locations', activeLocation: loc, expandedLocationIndex: index });

  if (!locationScenes.has(index)) {
    const canvasContainer = widgetRoot.querySelector(`#loc-canvas-${index}`) as HTMLElement | null;
    if (canvasContainer) {
      const ctx = initScene(canvasContainer, false);
      await ctx.logo.load();
      locationScenes.set(index, ctx);
    }
  }

  const ctx = locationScenes.get(index);
  if (ctx) {
    const rot = latLngToRotation(loc.lat, loc.lng);
    ctx.logo.rotateTo(rot);
  }

  const headerRot = latLngToRotation(loc.lat, loc.lng);
  headerScene.logo.rotateTo(headerRot);
  updateHeaderInfo(loc);
}
