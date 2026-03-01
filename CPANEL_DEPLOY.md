# نشر المشروع على سيرفر cPanel

خطوات تشغيل مشروع Laravel بشكل صحيح على استضافة cPanel.

---

## 1. رفع الملفات

- ارفع **كل** مجلدات وملفات المشروع إلى السيرفر (مثلاً داخل `laral` أو في المجلد الرئيسي للموقع).
- الطريقة الموصى بها:
  - ضع المشروع في مجلد **خارج** `public_html` إن أمكن (مثلاً: `laral`) ثم عدّل مسار الجذر كما في الخطوة 2.
  - أو ارفع المشروع كاملاً ثم اجعل **جذر الموقع (Document Root)** يشير إلى مجلد `public` فقط (انظر الخطوة 2).

---

## 2. ضبط جذر الموقع (Document Root)

في cPanel:

1. ادخل إلى **Domains** أو **Domains → Domain Setup**.
2. اختر الدومين أو النطاق الفرعي.
3. في **Document Root** غيّر المسار ليصبح مجلد **public** داخل مشروعك.

أمثلة:

- إذا المشروع في: `/home/username/laral`  
  اجعل Document Root: **`/home/username/laral/public`**

- إذا المشروع في: `/home/username/public_html/laral`  
  اجعل Document Root: **`/home/username/public_html/laral/public`**

بهذا الشكل يتم تشغيل Laravel من مجلد `public` فقط وهذا مطلوب لأمان واستقرار المشروع.

---

## 3. صلاحيات المجلدات

من **File Manager** أو عبر SSH نفّذ:

```bash
chmod -R 755 storage bootstrap/cache
chmod -R 775 storage bootstrap/cache
```

أو من واجهة الملفات: مجلدات `storage` و `bootstrap/cache` يجب أن تكون قابلة للكتابة (عادة 755 أو 775 حسب الاستضافة).

---

## 4. ملف البيئة `.env`

1. في جذر المشروع (خارج مجلد `public`) انسخ `.env.example` إلى `.env` إن لم يكن موجوداً.
2. عدّل `.env` للإنتاج:

```env
APP_NAME="اسم التطبيق"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=اسم_قاعدة_البيانات
DB_USERNAME=اسم_المستخدم
DB_PASSWORD=كلمة_المرور
```

3. مفتاح التطبيق (بعد الرفع أو من خلال SSH):

```bash
php artisan key:generate
```

إن لم يتوفر SSH، يمكن تشغيل الأمر من **Terminal** في cPanel إن كان مفعّلاً.

---

## 5. ربط مجلد التخزين (Storage Link)

من مجلد المشروع (جذر Laravel وليس `public`):

```bash
php artisan storage:link
```

إن لم يتوفر SSH/Terminal، بعض الاستضافات تسمح بتشغيل أوامر PHP من لوحة التحكم. إن تعذّر ذلك اطلب من الدعم تنفيذ الأمر.

---

## 6. تحسين الأداء (Cache)

بعد التأكد أن الموقع يعمل بشكل صحيح:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## 7. إعدادات PHP على cPanel

- تم إضافة ملف **`public/.user.ini`** لضبط إعدادات PHP المناسبة (الذاكرة، وقت التنفيذ، حجم الرفع).
- إن احتجت تغيير إصدار PHP: من cPanel → **Select PHP Version** اختر PHP 8.2 أو أحدث.

---

## 8. قاعدة البيانات MySQL

1. من cPanel → **MySQL® Databases** أنشئ:
   - قاعدة بيانات جديدة
   - مستخدم جديد
   - اربط المستخدم بقاعدة البيانات بصلاحيات **ALL PRIVILEGES**
2. أدخل نفس الاسم وكلمة المرور في `.env` (DB_DATABASE, DB_USERNAME, DB_PASSWORD).
3. عادةً `DB_HOST=localhost` مناسب لـ cPanel.

---

## ملخص سريع

| الخطوة              | الإجراء |
|---------------------|---------|
| رفع الملفات         | رفع المشروع كاملاً ثم ضبط Document Root على `public` |
| Document Root       | يجب أن يكون مجلد `public` داخل المشروع |
| الصلاحيات           | `storage` و `bootstrap/cache` قابلة للكتابة (755/775) |
| `.env`              | نسخ من `.env.example` وتعديل ثم `php artisan key:generate` |
| قاعدة البيانات      | إنشاء DB ومستخدم من cPanel وربطهما في `.env` |
| التخزين             | `php artisan storage:link` |
| الأداء              | `config:cache` و `route:cache` و `view:cache` |

بعد تنفيذ هذه الخطوات يكون المشروع جاهزاً للعمل على السيرفر بشكل جيد.
