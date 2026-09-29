import type { MetadataRoute } from 'next';

const routes = ['', '/services', '/request', '/privacy', '/terms'];

export default function sitemap(): MetadataRoute.Sitemap {
  const baseUrl = 'https://qemmat-almajd.ae';
  const lastModified = new Date();

  return ['en', 'ar'].flatMap((locale) => routes.map((route) => ({
    url: `${baseUrl}/${locale}${route}`,
    lastModified,
    alternates: {
      languages: {
        en: `${baseUrl}/en${route}`,
        ar: `${baseUrl}/ar${route}`,
      },
    },
  })));
}
