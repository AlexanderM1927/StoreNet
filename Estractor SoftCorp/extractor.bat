ECHO OFF
ECHO ------------------------------------------------------------------------------------------
ECHO      _______.  ______    _______ .___________.  ______   ______   .______      .______   
ECHO     /       l /  __  \  l   ____ll           l /      l /  __  \  l   _  \     l   _  \  
ECHO    l   (----`l  l  l  l l  l__   `---l  l----`l  ,----'l  l  l  l l  l_)  l    l  l_)  l 
ECHO     \   \    l  l  l  l l   __l      l  l     l  l     l  l  l  l l      /     l   ___/  
ECHO .----)   l   l  `--'  l l  l         l  l     l  `----.l  `--'  l l  l\  \----.l  l      
ECHO l_______/     \______/  l__l         l__l      \______l \______/  l _l `._____ll _l                                                                                              
ECHO Estractor de productos de una empresa by @SoftCorp 2020
ECHO ------------------------------------------------------------------------------------------
@ECHO.
@ECHO.
IF "%1"=="" (
ECHO Se necesita el parametro 1: URL
) ELSE (
IF "%2"=="" (
ECHO Se necesita el parametro 2: ID empresa
) ELSE (
IF "%1"=="https://www.alkomprar.com/celulares/telefonos-celulares/c/BI_101" (
del result.txt
curl %1 >> result.txt
php index.php Celular %2
) ELSE (
IF "%1"=="https://www.alkomprar.com/computadores-tablets/computadores-portatiles/c/BI_104" (
del result.txt
curl %1 >> result.txt
php index.php Computador %2
) ELSE (
IF "%1"=="https://www.alkomprar.com/videojuegos/juegos/c/BI_132" (
del result.txt
curl %1 >> result.txt
php index.php Juego %2
) ELSE (
IF "%1"=="https://www.alkomprar.com/tv-video/televisores/c/BI_120" (
del result.txt
curl %1 >> result.txt
php index.php TV %2
) ELSE (
ECHO No se tiene listo el contenido de esta página debido a que no fue hecho para este enlace.
ECHO Enlaces disponibles:
ECHO https://www.alkomprar.com/celulares/telefonos-celulares/c/BI_101
ECHO https://www.alkomprar.com/computadores-tablets/computadores-portatiles/c/BI_104
ECHO https://www.alkomprar.com/videojuegos/juegos/c/BI_132
ECHO https://www.alkomprar.com/tv-video/televisores/c/BI_120
)
)
)
)
)
)