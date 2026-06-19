import { chromium } from 'playwright';
import path from 'path';
import { fileURLToPath } from 'url';

const __dirname = path.dirname(fileURLToPath(import.meta.url));
const file = 'file:///' + path.join(__dirname, 'sagamu.html').replace(/\\/g, '/');

const browser = await chromium.launch();
const page = await browser.newPage();
await page.setViewportSize({ width: 1280, height: 900 });
await page.goto(file);
await page.waitForTimeout(1200); // wait for fonts

await page.screenshot({ path: 'shot_top.png',    clip: { x:0, y:0, width:1280, height:600 } });
await page.screenshot({ path: 'shot_full.png',   fullPage: true });

// cards section
await page.evaluate(() => window.scrollTo(0, 700));
await page.waitForTimeout(200);
await page.screenshot({ path: 'shot_cards.png',  clip: { x:0, y:0, width:1280, height:700 } });

// footer
await page.evaluate(() => window.scrollTo(0, document.body.scrollHeight));
await page.waitForTimeout(200);
await page.screenshot({ path: 'shot_footer.png' });

await browser.close();
console.log('Done.');
