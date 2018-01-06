
# Build and deploy

## Configure FTP settings

- configure `ftp.master.properties` with FTP settings of the target server

```
ftp.host=ftp.example.com
ftp.port=21
ftp.username=your-user-name
ftp.password=your-password
ftp.dir=public_html
ftp.mode=binary
```

## Source

```
> ./vendor/bin/phing build-src
> ./vendor/bin/phing deploy-src
```


Deploy using a **phing** target.
