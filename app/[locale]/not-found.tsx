import Link from 'next/link';

export default function NotFound() {
  return <main style={{ minHeight: '100vh', display: 'grid', placeItems: 'center', background: '#f5f7fa', color: '#0b2239', fontFamily: 'Inter, sans-serif' }}><div style={{ textAlign: 'center' }}><p style={{ color: '#c79a32', letterSpacing: '.15em', fontSize: 12 }}>404</p><h1>Page not found</h1><p style={{ color: '#667085' }}>The page you requested does not exist.</p><Link href="/en" style={{ color: '#0b2239', textDecoration: 'underline' }}>Return home</Link></div></main>;
}
