# Provisioning
To provision follow these steps:
- Add public key to root account on server (found in `deploy.php`)
- Add `.env.local` and `./var/data/GeoLite2-City.mmdb` files to their respective locations on the server
- Run ` vendor/bin/dep provision`
- Update the `/home/deployer/ishetkutweer/Caddyfile` with the following redirect
```
www.ishetkutweer.nl {
  redir https://{host}{uri}
}
```

# Deployment
To deploy follow these steps:
- Add public key to root account on server (found in `deploy.php`)
- Run ` vendor/bin/dep deploy`

# Todo
- Adjust website design for mobile users