import { chromium } from 'playwright';
import path from 'path';
import { fileURLToPath } from 'url';

const __dirname = path.dirname(fileURLToPath(import.meta.url));
const file = 'file:///' + path.join(__dirname, 'sagamu.html').replace(/\\/g, '/');

const browser = await chromium.launch();

async function snapTop(width, height, label, clipH) {
    const page = await browser.newPage();
    await page.setViewportSize({ width, height });
    await page.goto(file);
    await page.waitForTimeout(800);
    await page.screenshot({ path: `snap_${label}.png`, clip: { x: 0, y: 0, width, height: clipH } });
    await page.close();
    console.log(`${label} done`);
}

await snapTop(1280, 900, 'hdr_desktop', 200);
await snapTop(768, 1024, 'hdr_tablet',  280);
await snapTop(390, 844,  'hdr_mobile',  320);

await browser.close();
console.log('All done.');
