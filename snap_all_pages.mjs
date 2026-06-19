import { chromium } from 'playwright';
import path from 'path';
import { fileURLToPath } from 'url';

const __dirname = path.dirname(fileURLToPath(import.meta.url));
const base = 'file:///' + __dirname.replace(/\\/g, '/') + '/';

const browser = await chromium.launch();

async function snap(file, outname, clipH) {
    const page = await browser.newPage();
    await page.setViewportSize({ width: 1280, height: 900 });
    await page.goto(base + file);
    await page.waitForTimeout(700);
    if (clipH) {
        await page.screenshot({ path: `review_${outname}.png`, clip: { x: 0, y: 0, width: 1280, height: clipH } });
    } else {
        await page.screenshot({ path: `review_${outname}.png`, fullPage: true });
    }
    await page.close();
    console.log(`${outname} done`);
}

await snap('article.html',       'article',       null);
await snap('listing.html',       'listing',       null);
await snap('category.html',      'category',      null);
await snap('neighbourhood.html', 'neighbourhood', null);
await snap('list-business.html', 'list_business', null);
await snap('new-to-sagamu.html', 'new_to_sagamu', null);

await browser.close();
console.log('All pages captured.');
