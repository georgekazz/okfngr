# OKFN Greece - Open Knowledge Foundation Greece
 
![OKFN Greece](public/img/OKGR-landscape-full-rgb.svg)
 
A modern web platform for **Open Knowledge Foundation Greece**, built with Laravel. The platform serves as the main website, blog, and internal management tool for the organization.
 
---
 
## 🚀 Features
 
### Public Website
- Multi-language support (Greek / English)
- Dynamic homepage with slider and event banner
- Blog with categories, tags, pagination and share buttons
- Pages: About, Vision & Values, Our Impact, Our Team, Board of Directors, Governance
- Projects, Applications, Old Projects, Editions
- Open Data section: Open Data, How To, Why Open
- Media timeline with zoom controls and event popup
- Responsive design with HK Grotesk font
### Admin Panel
- User management (create, edit, delete, reset password)
- Post management with TinyMCE editor
- Comment moderation (approve / reject / delete)
- Team links management
- Media events management with Excel import/export
### Writer Dashboard
- Create and manage blog posts
- Manage media events
- Upload images
### User Panel
- Personal day-off management
- Team calendar
- Salary calculator (University + OKFN contracts)
- Statistics with charts (Chart.js)
- Team links
- Team day-off calendar with pagination
---
 
## 🛠️ Tech Stack
 
| Layer | Technology |
|-------|-----------|
| Backend | Laravel 10 |
| Frontend | Blade, Tailwind CSS, Custom CSS |
| Database | MySQL 8 |
| Editor | TinyMCE |
| Charts | Chart.js |
| Fonts | HK Grotesk |
| Deployment | Docker + Portainer |
 
---
 
## 📋 Requirements
 
- PHP >= 8.1
- Composer
- MySQL 8.0
- Node.js (for assets)
---
 
## ⚙️ Installation
 
### Local (XAMPP)
 
```bash
# Clone the repository
git clone https://github.com/georgekazz/okfngr.git
cd okfngr
 
# Install dependencies
composer install
 
# Copy environment file
cp .env.example .env
 
# Generate app key
php artisan key:generate
 
# Configure your .env database settings
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=okfngr
DB_USERNAME=root
DB_PASSWORD=
 
# Run migrations and seeders
php artisan migrate --seed
 
# Create storage symlink
php artisan storage:link
 
# Publish pagination views
php artisan vendor:publish --tag=laravel-pagination
```
 
### Docker (Production)
 
```bash
# Copy and configure environment
cp .env.example .env
# Fill in APP_KEY, DB credentials etc.
 
# Build and start containers
docker-compose up -d --build
 
```
 
---
 
## 👥 User Roles
 
| Role | Access |
|------|--------|
| `admin` | Full access — users, posts, comments, team links, media events |
| `writer` | Blog posts, media events |
| `user` | Day-offs, calendar, salary calculator, statistics |
 
---
 
## 🐳 Docker
 
The project includes a `docker-compose.yml` with:
- **app** — PHP/Apache container
- **db** — MySQL 8.0 container
- **storage_data** volume — persists uploaded images across redeploys
---
 
## 📄 License
 
This project is developed by Georgios Christoforos Kazlaris for **Open Knowledge Foundation Greece**.  
Content is licensed under [Creative Commons BY 4.0](https://creativecommons.org/licenses/by/4.0/).
 
---
 
## 🔗 Links
 
- Website: [okfn.gr](https://okfn.gr)
- OKFN International: [okfn.org](https://okfn.org)
- GitHub: [github.com/okgreece](https://github.com/okgreece)