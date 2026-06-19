import { chromium } from 'playwright';
import path from 'path';
import { fileURLToPath } from 'url';

const __dirname = path.dirname(fileURLToPath(import.meta.url));
const file = 'file:///' + path.join(__dirname, 'sagamu.html').replace(/\\/g, '/');

const browser = await chromium.launch();

async function snap(width, height, label) {
    const page = await browser.newPage();
    await page.setViewportSize({ width, height });
    await page.goto(file);
    await page.waitForTimeout(800);
    await page.screenshot({ path: `shot_${label}.png`, fullPage: true });
    await page.close();
    console.log(`${label} (${width}px) done`);
}

await snap(1280, 900,  'desktop');
await snap(768,  1024, 'tablet');
await snap(390,  844,  'mobile');

await browser.close();
console.log('All done.');
