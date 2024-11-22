<!--Variables Entorno-->
<script>
    let appUrl = "<?= APP_URL; ?>";
    let appDebug = "<?= $_ENV['DEBUG']; ?>";
    let arcGisKey = "<?= $_ENV['ARCGIS_KEY']; ?>";
    if (appDebug === 'ON') { console.log(`appUrl: ${appUrl}`); }
    if (appDebug === 'ON') { console.log(`arcGisKey: ${arcGisKey}`); }
</script>
<!--Librerias-->
<!-- CDN Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
<!--Archivos Adicionales-->
<script src="<?= AJS . '/test.js'; ?>"></script>
