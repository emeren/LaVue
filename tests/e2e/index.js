// Login helper
Cypress.Commands.add("login", () => {
    cy.visit("/panel/login");

    cy.get("input[name='email']")
        .type(Cypress.env("email"))
        .should("have.value", Cypress.env("email"));
    cy.get("input[name='password'").type(Cypress.env("password"));

    cy.get("button[type='submit']").click();
});
