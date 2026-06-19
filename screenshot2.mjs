import { chromium } from 'playwright';
import path from 'path';
import { fileURLToPath } from 'url';

const __dirname = path.dirname(fileURLToPath(import.meta.url));
const file = 'file:///' + path.join(__dirname, 'sagamu.html').replace(/\\/g, '/');

const browser = await chromium.launch();
const page = await browser.newPage();
await page.setViewportSize({ width: 1280, height: 900 });
await page.goto(file);
await page.waitForTimeout(500);

// Scroll to very bottom then screenshot the viewport
await page.evaluate(() => window.scrollTo(0, document.body.scrollHeight));
await page.waitForTimeout(300);
await page.screenshot({ path: 'shot_footer2.png' });

// Nav gap: scroll back to top
await page.evaluate(() => window.scrollTo(0, 0));
await page.waitForTimeout(200);
await page.screenshot({ path: 'shot_nav_gap.png', clip: { x: 0, y: 0, width: 1280, height: 260 } });

await browser.close();
console.log('Done.');
