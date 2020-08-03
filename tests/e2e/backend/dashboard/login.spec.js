describe("Login page test", () => {
    it("users can login to backend", () => {
        cy.login();
        cy.url().should("be", "/panel/");
        cy.getCookie("XSRF-TOKEN").should("exist");
        cy.get("h1").should("be", "Pulpit");
    });

    it("users can reset password", () => {
        cy.visit("/panel/login");
        cy.get("input[name='email']");
        cy.get("a.forgetPassword").click();
        cy.url().should("be", "/panel/password/reset/");
        cy.get("#email").type(Cypress.env("email"));
        cy.get("button[type='submit']").click();
        cy.url().should("be", "/panel/password/reset/");
        cy.get(".login-box-msg").should("exist");

        cy.get(".login-box-msg").should(
            "be",
            "Na twój adres email wysłaliśmy link resetujący hasło"
        );
        cy.get("h1").should("be", "Pulpit");
    });
});
