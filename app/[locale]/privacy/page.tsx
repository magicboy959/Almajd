const policy = {
  en: {
    dir: 'ltr',
    home: 'Back to home',
    title: 'Privacy policy',
    updated: 'Last updated: September 30, 2026',
    intro: 'Qemmat Al Majd Business Services respects your privacy. This policy explains how we handle information shared with us when you contact us, submit a request, or use this website.',
    sections: [
      ['Information we collect', 'We may collect contact details, service request details, uploaded or shared documents, communication history, and technical website information such as browser, device, and general usage data.'],
      ['How we use information', 'We use information to respond to inquiries, prepare and follow up on service requests, communicate status updates, improve our website, and meet recordkeeping or compliance needs.'],
      ['Document handling', 'Documents are handled only for the service requested. Access is limited to team members who need the information to support the request.'],
      ['Sharing information', 'When required for a requested service, information may be submitted through relevant official channels, government platforms, courts, service centers, or professional service providers. We do not sell personal information.'],
      ['Retention and security', 'We keep information only as long as needed for service delivery, follow-up, legal, accounting, or operational requirements. We use reasonable safeguards to reduce unauthorized access or misuse.'],
      ['Your choices', 'You may contact us to update your details, ask about information related to your request, or ask us to stop non-essential communications. Some records may need to be retained for legal or operational reasons.'],
      ['Contact', 'For privacy questions, contact us at hello@qemmat-almajd.ae or +971 56 657 9033.'],
    ],
  },
  ar: {
    dir: 'rtl',
    home: 'العودة للرئيسية',
    title: 'سياسة الخصوصية',
    updated: 'آخر تحديث: 30 سبتمبر 2026',
    intro: 'تحترم قمة المجد لخدمات رجال الأعمال خصوصيتكم. توضح هذه السياسة كيفية التعامل مع المعلومات التي تشاركونها معنا عند التواصل معنا أو تقديم طلب أو استخدام هذا الموقع.',
    sections: [
      ['المعلومات التي نجمعها', 'قد نجمع بيانات التواصل، وتفاصيل طلب الخدمة، والمستندات التي يتم رفعها أو مشاركتها، وسجل التواصل، ومعلومات تقنية عن استخدام الموقع مثل المتصفح والجهاز وبيانات الاستخدام العامة.'],
      ['كيفية استخدام المعلومات', 'نستخدم المعلومات للرد على الاستفسارات، وتجهيز ومتابعة طلبات الخدمات، وإرسال تحديثات الحالة، وتحسين الموقع، وتلبية متطلبات الحفظ أو الامتثال عند الحاجة.'],
      ['التعامل مع المستندات', 'يتم التعامل مع المستندات فقط لغرض الخدمة المطلوبة، ويقتصر الوصول إليها على أعضاء الفريق المعنيين بدعم الطلب.'],
      ['مشاركة المعلومات', 'عند الحاجة لإنجاز الخدمة المطلوبة، قد يتم تقديم المعلومات عبر القنوات الرسمية ذات الصلة أو المنصات الحكومية أو المحاكم أو مراكز الخدمة أو مزودي الخدمات المهنية. لا نقوم ببيع المعلومات الشخصية.'],
      ['الاحتفاظ والأمان', 'نحتفظ بالمعلومات للمدة اللازمة لتقديم الخدمة أو المتابعة أو تلبية المتطلبات القانونية أو المحاسبية أو التشغيلية. ونستخدم إجراءات معقولة للحد من الوصول غير المصرح به أو إساءة الاستخدام.'],
      ['خياراتكم', 'يمكنكم التواصل معنا لتحديث بياناتكم أو الاستفسار عن المعلومات المتعلقة بطلبكم أو طلب إيقاف الرسائل غير الضرورية. قد يلزم الاحتفاظ ببعض السجلات لأسباب قانونية أو تشغيلية.'],
      ['التواصل', 'للاستفسارات المتعلقة بالخصوصية، يمكنكم التواصل عبر hello@qemmat-almajd.ae أو +971 56 657 9033.'],
    ],
  },
} as const;

export function generateMetadata({ params }: { params: { locale: string } }) {
  const lang = params.locale === 'ar' ? 'ar' : 'en';

  return {
    title: lang === 'ar' ? 'سياسة الخصوصية | قمة المجد' : 'Privacy Policy | Qemmat Al Majd',
    description: lang === 'ar'
      ? 'سياسة الخصوصية لقمة المجد لخدمات رجال الأعمال وكيفية التعامل مع بيانات العملاء والمستندات.'
      : 'Privacy policy for Qemmat Al Majd Business Services and how customer information and documents are handled.',
  };
}

export default function PrivacyPage({ params }: { params: { locale: string } }) {
  const lang = params.locale === 'ar' ? 'ar' : 'en';
  const t = policy[lang];

  return <main className="legal-page" dir={t.dir}>
    <section className="legal-hero">
      <div className="container">
        <a className="legal-back" href={`/${lang}`}>{t.home}</a>
        <div className="eyebrow">Qemmat Al Majd Business Services</div>
        <h1>{t.title}</h1>
        <p className="legal-updated">{t.updated}</p>
        <p>{t.intro}</p>
      </div>
    </section>
    <section className="section">
      <div className="container legal-content">
        {t.sections.map(([title, text]) => <article className="legal-section" key={title}>
          <h2>{title}</h2>
          <p>{text}</p>
        </article>)}
      </div>
    </section>
  </main>;
}
