import { createI18n } from "vue-i18n";

const i18n = createI18n({
  locale: "br",
  messages: {
    br: {
      AppTitle: "Workana",
      home: {
        title: "Pagina inicial",
      },
      product: {
        title: "Informaçoes do produto",
      },
      navBar: {
        home: "Inicio",
        search: "Pesquisar",
      },
    },
  },
});

export default i18n;
