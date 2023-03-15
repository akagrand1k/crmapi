module.exports = {
  chainWebpack: config => {
    config.plugins.delete('pwa');
    config.plugins.delete('workbox');
  },
  pluginOptions: {
    quasar: {
      importStrategy: 'kebab',
      rtlSupport: false
    }
  },
  transpileDependencies: [
    'quasar'
  ]
}
