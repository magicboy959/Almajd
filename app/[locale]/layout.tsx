import type { Metadata } from 'next';

const metadataByLocale = {
  en: {
    title: 'Qemmat Al Majd | Government & Legal Services in the UAE',
    description: 'Business-services support for UAE government transactions, legal coordination, immigration, traffic, parking, labor and document services.',
  },
  ar: {
    title: 'قمة المجد | الخدمات الحكومية والقانونية في الإمارات',
    description: 'دعم لخدمات المعاملات الحكومية والقانونية والهجرة والمرور والمواقف والعمل والمستندات في دولة الإمارات.',
  },
} as const;

const businessSchema = {
  '@context': 'https://schema.org',
  '@type': 'ProfessionalService',
  name: 'Qemmat Al Majd Business Services',
  alternateName: 'قمة المجد لخدمات رجال الأعمال',
  description: 'Independent business-services support for UAE government, legal, immigration, traffic, labor and document services.',
  areaServed: {
    '@type': 'Country',
    name: 'United Arab Emirates',
  },
  address: {
    '@type': 'PostalAddress',
    addressLocality: 'Abu Dhabi',
    addressCountry: 'AE',
  },
  email: 'hello@qemmat-almajd.ae',
  telephone: ['+971566579033', '+971589271774', '+97124469035'],
  contactPoint: [
    {
      '@type': 'ContactPoint',
      telephone: '+971566579033',
      contactType: 'customer service',
      areaServed: 'AE',
      availableLanguage: ['English', 'Arabic'],
    },
  ],
  knowsAbout: [
    'Government services',
    'Legal coordination',
    'Immigration services',
    'Business setup',
    'Traffic services',
    'Parking services',
    'Document preparation',
  ],
};

export function generateMetadata({ params }: { params: { locale: string } }): Metadata {
  const locale = params.locale === 'ar' ? 'ar' : 'en';
  const meta = metadataByLocale[locale];

  return {
    title: meta.title,
    description: meta.description,
    alternates: {
      canonical: `/${locale}`,
      languages: {
        en: '/en',
        ar: '/ar',
      },
    },
    openGraph: {
      title: meta.title,
      description: meta.description,
      locale: locale === 'ar' ? 'ar_AE' : 'en_AE',
      siteName: 'Qemmat Al Majd Business Services',
      type: 'website',
    },
  };
}

export default function LocaleLayout({ children }: { children: React.ReactNode }) {
  return <>
    <script
      type="application/ld+json"
      dangerouslySetInnerHTML={{ __html: JSON.stringify(businessSchema) }}
    />
    {children}
  </>;
}
