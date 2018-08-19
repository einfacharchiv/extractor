<?php

namespace einfachArchiv\Extractor;

class Extractor extends Extraction
{
    /**
     * Extracts amounts from the text.
     *
     * @return array
     */
    public function findAmounts()
    {
        return (new Amount($this->text, $this->locales))->handle();
    }

    /**
     * Extracts BICs from the text.
     *
     * @return array
     */
    public function findBics()
    {
        return (new Bic($this->text))->handle();
    }

    /**
     * Extracts company names from the text.
     *
     * @return array
     */
    public function findCompanyNames()
    {
        return (new CompanyName($this->text, $this->locales))->handle();
    }

    /**
     * Extracts company register IDs from the text.
     *
     * @return array
     */
    public function findCompanyRegisterIds()
    {
        return (new CompanyRegisterId($this->text, $this->locales))->handle();
    }

    /**
     * Extracts customer IDs from the text.
     *
     * @return array
     */
    public function findCustomerIds()
    {
        return (new CustomerId($this->text, $this->locales))->handle();
    }

    /**
     * Extracts dates from the text.
     *
     * @return array
     */
    public function findDates()
    {
        return (new Date($this->text, $this->locales))->handle();
    }

    /**
     * Extracts emails from the text.
     *
     * @return array
     */
    public function findEmails()
    {
        return (new Email($this->text))->handle();
    }

    /**
     * Extracts IBANs from the text.
     *
     * @return array
     */
    public function findIbans()
    {
        return (new Iban($this->text))->handle();
    }

    /**
     * Extracts invoice IDs from the text.
     *
     * @return array
     */
    public function findInvoiceIds()
    {
        return (new InvoiceId($this->text, $this->locales))->handle();
    }

    /**
     * Extracts payment references from the text.
     *
     * @return array
     */
    public function findPaymentReferences()
    {
        return (new PaymentReference($this->text, $this->locales))->handle();
    }

    /**
     * Extracts tax numbers from the text.
     *
     * @return array
     */
    public function findTaxNumbers()
    {
        return (new TaxNumber($this->text, $this->locales))->handle();
    }

    /**
     * Extracts types from the text.
     *
     * @return array
     */
    public function findTypes()
    {
        return (new Type($this->text, $this->locales))->handle();
    }

    /**
     * Extracts VAT numbers from the text.
     *
     * @return array
     */
    public function findVatNumbers()
    {
        return (new VatNumber($this->text))->handle();
    }

    /**
     * Extracts websites from the text.
     *
     * @return array
     */
    public function findWebsites()
    {
        return (new Website($this->text))->handle();
    }
}
