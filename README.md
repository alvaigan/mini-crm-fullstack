# CALL ONMini CRM 

A modern Customer Relationship Management (CRM) application built with Laravel and Vue.js, designed for efficient contact management and call tracking.

## Table of Contents

- [Overview](#overview)
- [Architecture](#architecture)
- [Features](#features)
- [Docker Setup](#docker-setup)
- [Project Structure](#project-structure)
- [API Endpoints](#api-endpoints)
- [Assumptions](#assumptions)
- [Development Notes](#development-notes)

## Overview

This mini-CRM system provides a clean and intuitive interface for managing business contacts and tracking call logs. It follows a modern full-stack approach with a Laravel backend API and Vue.js frontend, all containerized using Docker for easy deployment and development.

## Architecture

### Backend (Laravel 12 + PHP 8.2)
- **Framework**: Laravel 12 with PHP 8.2
- **Database**: MySQL 8.0
- **Authentication**: Laravel Sanctum (configured)
- **API**: RESTful JSON API
- **ORM**: Eloquent

### Frontend (Vue.js 2 + Vite)
- **Framework**: Vue.js 2.7
- **Build Tool**: Vite 6.3
- **Styling**: TailwindCSS 4.0
- **State Management**: Vuex 3.6
- **UI Components**: Vuesax, Phosphor Vue icons

### Infrastructure
- **Containerization**: Docker + Docker Compose
- **Database**: MySQL 8.0 with persistent volumes
- **Development**: Hot reload for both frontend and backend

## Features

- **Contact Management**
  - Create, read, update, delete contacts
  - Contact details: name, phone, company, role
  - Favorite contacts functionality
  - Role-based contact categorization

- **Call Logging**
  - Track call duration and status
  - Associate calls with contacts
  - Call history management

- **Real-time Interface**
  - Live call timer functionality
  - Interactive calling dialog
  - Responsive dashboard layout

## Docker Setup

### Prerequisites

- Docker (20.0+)
- Docker Compose (2.0+)

### Quick Start

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd mini-crm-backend
   ```

2. **Start the application**
   ```bash
   docker-compose up -d
   ```

3. **Initialize the database**
   ```bash
   # Wait for containers to be ready, then run migrations
   docker exec mini-crm-app php artisan migrate --seed
   ```

4. **Access the application**
   - Frontend: http://localhost:5173
   - Backend API: http://localhost:8000
   - Database: localhost:3307

### Services

| Service | Container Name | Port | Description |
|---------|---------------|------|-------------|
| **app** | mini-crm-app | 8000 | Laravel backend API |
| **frontend** | mini-crm-frontend | 5173 | Vue.js frontend |
| **mysql** | mini-crm-mysql | 3307 | MySQL database |

### Docker Configuration

- **PHP Container**: PHP 8.2-FPM with all necessary extensions
- **Node Container**: Node.js 18 Alpine for optimal performance
- **MySQL Container**: MySQL 8.0 with persistent data volume
- **Network**: Isolated bridge network for inter-service communication

### Environment Variables

The PHP container automatically creates a `.env` file with these settings:

```env
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=mini_crm
DB_USERNAME=mini_crm_user
DB_PASSWORD=mini_crm_password
```

## Project Structure

```
mini-crm-backend/
├── app/
│   ├── Http/Controllers/     # API Controllers
│   └── Models/              # Eloquent Models
├── database/
│   ├── migrations/          # Database schema
│   └── seeders/            # Test data seeders
├── resources/js/
│   ├── src/
│   │   ├── components/     # Vue components
│   │   ├── pages/         # Vue pages
│   │   ├── stores/        # Vuex stores
│   │   └── api/           # API client
│   └── App.vue            # Root component
├── routes/api.php          # API routes
├── docker-compose.yml      # Container orchestration
├── Dockerfile.php         # PHP container config
└── Dockerfile.node        # Node container config
```

## API Endpoints

### Contacts
- `GET /api/contacts/` - List all contacts
- `POST /api/contacts/` - Create new contact
- `PUT /api/contacts/{id}` - Update contact
- `DELETE /api/contacts/{id}` - Delete contact
- `POST /api/contacts/{id}/toggle-favorite` - Toggle favorite status

### Call Logs
- `GET /api/call-logs/` - List call logs
- `POST /api/call-logs/` - Create call log

### Roles
- `GET /api/roles/` - List available roles

## Assumptions

### Technical Assumptions
- **Environment**: Development-focused setup with debug enabled
- **Database**: MySQL is sufficient for the scale and requirements
- **Authentication**: Sanctum is configured but not implemented in current UI
- **Scaling**: Single-instance deployment suitable for current scope

### Business Logic Assumptions
- **Contact Uniqueness**: No built-in duplicate detection (assumed to be handled by business process)
- **Call Status**: Simple string-based status tracking (e.g., "completed", "missed", "ongoing")
- **Roles**: Static role system via database seeding
- **Data Persistence**: All data stored in MySQL with standard Laravel timestamps

### Frontend Assumptions
- **Browser Support**: Modern browsers with ES6+ support
- **Mobile**: Responsive design but desktop-first approach
- **Real-time**: Call timer is client-side only (no server-side call state tracking)

### Infrastructure Assumptions
- **Deployment**: Docker-based deployment environment
- **Storage**: Local file system storage (no cloud storage integration)
- **Caching**: Database-based caching for simplicity
- **Sessions**: Database session storage for multi-container compatibility

## Development Notes

### Hot Reload
Both frontend and backend support hot reload during development:
- **Vite**: Automatically reloads frontend changes
- **Laravel**: File changes are reflected immediately via volume mounts

### Database Seeding
The project includes seeders for roles and sample contacts:
```bash
docker exec mini-crm-app php artisan db:seed
```

### Logs
Access application logs:
```bash
docker logs mini-crm-app      # Laravel logs
docker logs mini-crm-frontend # Frontend build logs
docker logs mini-crm-mysql    # Database logs
```

### Troubleshooting
- Ensure ports 3307, 5173, and 8000 are available
- Wait for MySQL to fully initialize before running migrations
- Check container health: `docker-compose ps`

---
