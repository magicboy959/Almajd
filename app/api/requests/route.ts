import { NextResponse } from 'next/server';

let sequence = 1;

export async function POST(request: Request) {
  const body = await request.json();
  const required = ['name', 'mobile', 'email', 'service', 'details'];
  if (required.some(field => typeof body[field] !== 'string' || !body[field].trim()) || body.consent !== true) {
    return NextResponse.json({ message: 'Please complete the required fields and consent.' }, { status: 422 });
  }
  const reference = `QM-${new Date().getFullYear()}-${String(sequence++).padStart(6, '0')}`;
  return NextResponse.json({ reference, status: 'New' }, { status: 201 });
}
