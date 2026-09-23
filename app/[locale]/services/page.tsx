'use client';

import { useEffect, useState } from 'react';
import Link from 'next/link';
import { ArrowLeft, ArrowRight, Search } from 'lucide-react';

type Service = { id: number; name_en: string; name_ar: string; slug: string; category: { name_en: string; name_ar: string } };
const configuredApi = process.env.NEXT_PUBLIC_API_URL?.trim();
const api = configuredApi && /^https?:\/\//.test(configuredApi) ? configuredApi.replace(/\/$/, '') : 'http://localhost:8000/api/v1';

export default function ServicesPage({ params }: { params: { locale: string } }) {
  const arabic = params.locale === 'ar';
  const [query, setQuery] = useState('');
  const [services, setServices] = useState<Service[]>([]);
  useEffect(() => { fetch(`${api}/services?locale=${arabic ? 'ar' : 'en'}`).then(response => response.json()).then(data => setServices(data.data?.data || [])).catch(() => setServices([])); }, [arabic]);
  const filtered = services.filter(service => `${service.category?.name_en} ${service.name_en} ${service.name_ar}`.toLowerCase().includes(query.toLowerCase()));
  const Back = arabic ? ArrowRight : ArrowLeft;
  return <main dir={arabic ? 'rtl' : 'ltr'} style={{ minHeight: '100vh', background: '#f5f7fa' }}><header style={{ background: '#0b2239', color: 'white', padding: '22px 0' }}><div className="container" style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center' }}><Link href={`/${params.locale}`} style={{ fontWeight: 700 }}>QEMMAT AL MAJD</Link><Link href={arabic ? '/en/services' : '/ar/services'} style={{ fontSize: 13 }}>{arabic ? 'English' : 'العربية'}</Link></div></header><div className="container" style={{ padding: '64px 0' }}><Link href={`/${params.locale}`} style={{ display: 'inline-flex', gap: 8, alignItems: 'center', color: '#667085', fontSize: 13 }}><Back size={15} /> {arabic ? 'العودة للرئيسية' : 'Back home'}</Link><div className="section-heading" style={{ marginTop: 32 }}><div className="eyebrow">{arabic ? 'دليل الخدمات' : 'Service directory'}</div><h2>{arabic ? 'خدمات واضحة للخطوة التالية.' : 'A clear route to your next step.'}</h2><p>{arabic ? 'استكشف مجالات الدعم المتاحة وابدأ طلبك عندما تكون مستعداً.' : 'Explore the areas we support and start a request when you are ready.'}</p></div><div style={{ display: 'flex', gap: 10, maxWidth: 580, marginBottom: 32 }}><div style={{ display: 'flex', flex: 1, alignItems: 'center', gap: 10, border: '1px solid #dce2e8', background: 'white', padding: '0 14px' }}><Search size={18} color="#667085" /><input aria-label="Search services" value={query} onChange={event => setQuery(event.target.value)} placeholder={arabic ? 'ابحث عن خدمة' : 'Search services'} style={{ width: '100%', border: 0, outline: 0, padding: '15px 0', background: 'transparent' }} /></div><Link className="btn btn-primary" href={`/${params.locale}/request`}>{arabic ? 'تقديم طلب' : 'Start request'}</Link></div><div className="category-grid">{filtered.map(service => <article className="category" key={service.id}><div><div className="eyebrow">{arabic ? service.category?.name_ar : service.category?.name_en}</div><h3>{arabic ? service.name_ar : service.name_en}</h3><p>{arabic ? 'متطلبات واضحة، ومدة تقديرية، ومساعدة من فريقنا.' : 'Clear requirements, estimated timing and guidance from our team.'}</p></div><Link href={`/${params.locale}/request?service=${encodeURIComponent(service.name_en)}`} style={{ color: '#c79a32', fontSize: 13, fontWeight: 700 }}>{arabic ? 'ابدأ الطلب' : 'Start request'} <ArrowRight size={14} /></Link></article>)}</div>{filtered.length === 0 && <p style={{ color: '#667085', padding: '30px 0' }}>{arabic ? 'لم نعثر على خدمات مطابقة.' : 'No matching services found.'}</p>}</div></main>;
}
