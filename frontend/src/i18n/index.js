import { createI18n } from "vue-i18n";

const i18n = createI18n({
  locale: "br",
  messages: {
    br: {
      moneyUnity: "R$",
      AppTitle: "Workana",
      save: "Salvar",
      home: {
        title: "Pagina inicial",
      },
      product: {
        title: "Lista de Produtos",
        addToCart: "Adicionar ao carrinho",
        label: {
          name: "Nome",
          value: "Valor",
          stock: "Quantidade em estoque",
          product_category: "Categoria",
          tax: "Imposto",
        },
        create: {
          title: "Criar Produto",
          success: "Criado com sucesso!",
          errors: {
            success: "Nao foi possivel criar o produto!",
            name: "Informe o nome do produto",
            value: "Informe o valor do produto",
            quantity: "Informe a quantidade do produto",
            product_category_id: "Selecione a categoria",
          },
        },
      },
      productCategory: {
        title: "Lista de categorias",
        label: {
          name: "Nome",
          tax: "Imposto da categoria",
        },
        create: {
          title: "Cadastrar categoria",
          success: "Criado com sucesso!",
          errors: {
            success: "Nao foi possivel criar a categoria!",
            name: "Informe o nome da categoria",
            tax: "Informe o imposto da categoria",
          },
        },
      },
      navBar: {
        home: "Inicio",
        product: { name: "Produto", path: "/product/create" },
        productCategory: {
          name: "Categoria",
          path: "/product-category/create",
        },
        search: "Pesquisar",
        bottomNavBar: {
          total: "Valor Total do carrinho:",
          quantity: "Itens",
        },
      },
      cart: {
        title: {
          name: "Produto",
          value: "Valor",
          remove: "Diminuir",
          quantity: "Quantidade",
          add: "Adicionar",
        },
      },
    },
  },
});

export default i18n;
