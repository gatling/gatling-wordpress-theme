$(document).ready(function () {
  function url(version) {
    return (
      "https://repo1.maven.org/maven2/io/gatling/highcharts/gatling-charts-highcharts-bundle/" +
      version +
      "/gatling-charts-highcharts-bundle-" +
      version +
      "-bundle.zip"
    );
  }

  // javascript:DownloadBundle('3.4.1')
  function DownloadBundle(version, redirectTo) {
    location.href = url(version);
  }
  window.DownloadBundle = DownloadBundle;

  var defaultPause = 0.1; // seconds

  // javascript:DownloadBundleAndRedirect('3.4.1', '/open-source/start-testing/')
  function DownloadBundleAndRedirect(version, redirectTo) {
    location.href = url(version);
    setTimeout(function () {
      window.location = redirectTo;
    }, defaultPause * 1000);
  }
  window.DownloadBundleAndRedirect = DownloadBundleAndRedirect;
});
