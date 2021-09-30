import { NowRequest, NowResponse } from '@vercel/node';

const CACHE_BROWSER = 60 * 60 * 24 * 1; // 1 day
const CACHE_CDN = 60 * 60 * 24 * 5; // 5 days

export default async function handler(req: NowRequest, res: NowResponse) {
  console.log("HTTP", req.url);

  // Apply optimistic CORS
  res.setHeader("Access-Control-Allow-Origin", '*');
  res.setHeader("Access-Control-Allow-Methods", '*');
  res.setHeader("Access-Control-Allow-Headers", '*');

  // OPTIONS request
  if (req.method === 'OPTIONS') {
    res.statusCode = 200;
    res.end();
    return
  }

  const output = {
    timestamp: Date.now(),
    date: new Date().toISOString()
  }

  res.setHeader('Content-Type', 'application/json')
  res.setHeader('Cache-Control', `max-age=${CACHE_BROWSER}, s-maxage=${CACHE_CDN}, public`);
  res.send(JSON.stringify(output));
}
