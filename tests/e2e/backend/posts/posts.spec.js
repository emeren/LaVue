describe("Posts page test", () => {
    it("users can visit posts page", () => {
        cy.login();
        cy.visit("/panel#/posts");
        cy.get("h1").should("be", "Posts");
    });

    it("users see posts list", () => {
        cy.login();
        cy.visit("/panel#/posts");
        cy.get("tbody>tr").eq(0);
    });

    it("users can visit single post", () => {
        cy.login();
        cy.visit("/panel#/posts/1");
        cy.get("h1").should("be", "Edycja posta");

    });
});
