# تنظيم المشروع – القواعد التي نلتزم بها

## 1. الـ Routes (المسارات)

- **ملف واحد لكل قسم:** لا نضع كل المسارات في `web.php` فقط.
- **`routes/web.php`:** الصفحات العامة فقط (مثل الرئيسية)، ثم يستدعي ملفات الأقسام عبر `require`.
- **`routes/dashboard.php`:** كل مسارات لوحة التحكم (بدون وضع مسارات المستخدمين داخلها يدوياً).
- **`routes/dashboard/users.php`:** مسارات قسم المستخدمين فقط (مثل القائمة، إنشاء، تعديل).
- تسمية المسارات: `dashboard.index`, `dashboard.users.index`, `dashboard.users.create` (كل مجموعة لها بادئة واضحة).

## 2. الـ Controllers (المتحكمات)

- **كل قسم له Controller مستقل:** مثلاً `DashboardController`, `UserController`.
- **كل دالة تعيد View واحد:** لا نضع منطق تجاري ثقيل داخل المتحكم؛ نستخدمه للتوجيه وإرجاع الـ view مع البيانات.
- استخدام **type-hint** للقيمة المرجعة: `(): View`.
- إمكانية جعل الـ Controller **final** إن لم يُورَّث.

## 3. الـ Views (العروض)

- **صفحة واحدة = ملف واحد:** كل مسار (صفحة) له ملف Blade خاص (مثل `dashboard/index`, `users/index`, `users/create`).
- **التخطيط الموحد:** صفحات الداشبورد تمتد من `layouts.dashboard`.
- **تقسيم التخطيط:**
  - `layouts/dashboard.blade.php`: الهيكل العام + الشريط العلوي (navbar) مضمّن فيه حتى تعمل @section و @yield بشكل صحيح.
  - `layouts/sidebar.blade.php`: القائمة الجانبية فقط (يُستدعى عبر @include).
  - `layouts/navbar.blade.php`: نسخة مرجعية لهيكل الـ navbar (للتوحيد مع الواجهة).
- **المكونات القابلة لإعادة الاستخدام:** في `resources/views/components/` (مثل `button`, `navbar-add-button`).

## 4. أسماء المسارات والـ Views

| المسار (URL)        | اسم الـ Route              | Controller        | View              |
|---------------------|----------------------------|-------------------|-------------------|
| `/`                 | `home`                     | —                 | `welcome`         |
| `/dashboard`        | `dashboard.index`          | DashboardController| `dashboard.index` |
| `/dashboard/users`  | `dashboard.users.index`    | UserController    | `users.index`     |
| `/dashboard/users/create` | `dashboard.users.create` | UserController    | `users.create`    |
| `/login`                 | `login`                 | AuthController    | `auth.login`      |
| `/register`              | `register`              | AuthController    | `auth.register`   |
| `/logout` (POST)         | `logout`                | AuthController    | —                 |

## 5. إضافة صفحة جديدة

1. **Route:** إما في الملف المناسب (مثل `routes/dashboard/users.php`) أو إنشاء ملف جديد مثل `routes/dashboard/settings.php` واستدعاؤه من `dashboard.php`.
2. **Controller:** إضافة دالة جديدة أو إنشاء Controller جديد للقسم.
3. **View:** إنشاء ملف جديد تحت `resources/views/` (مثل `users/edit.blade.php` أو `settings/index.blade.php`).

بهذا يبقى المشروع منظمًا وقابلًا للتوسع مع الحفاظ على جودة الكود.
