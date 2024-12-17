# Provisioning
To provision follow these steps:
- Add public key to root account on server (found in `deploy.php`)
- Add `.env.local` and `./var/data/GeoLite2-City.mmdb` files to their respective locations on the server
- Run ` vendor/bin/dep provision`

# Deployment
To deploy follow these steps:
- Add public key to root account on server (found in `deploy.php`)
- Run ` vendor/bin/dep deploy`

# Todo
- Adjust website design for mobile users
- Redirect www-domain
- Auto-deploy through Github actions
- Fix error logging