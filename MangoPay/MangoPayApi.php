<?php
namespace MangoPay;

/**
 * MangoPay API main entry point.
 * Provides managers to connect, send and read data from MangoPay API
 * as well as holds configuration/authorization data.
 */
class MangoPayApi {
    
    /////////////////////////////////////////////////
    // Config/authorization related props
    /////////////////////////////////////////////////

    /**
     * Authorization token methods
     * @var \MangoPay\AuthorizationTokenManager
     */
    public $OAuthTokenManager;

    /**
     * Configuration instance
     * @var \MangoPay\Libraries\Configuration
     */
    public $Config;
    
    /////////////////////////////////////////////////
    // API managers props
    /////////////////////////////////////////////////

    /**
     * OAuth methods
     * @var ApiOAuth
     */
    public $AuthenticationManager;

    /**
     * Clients methods
     * @var Client 
     */
    public $Clients;
    
    /**
     * Users methods
     * @var ApiUsers 
     */
    public $Users;
    
    /**
     * Wallets methods
     * @var ApiWallets
     */
    public $Wallets;
        
    /**
     * Transfers methods
     * @var ApiTransfers
     */
    public $Transfers;
    
    /**
     * Pay-in methods
     * @var ApiPayIns 
     */
    public $PayIns;
    
    /**
     * Pay-out methods
     * @var ApiPayOuts 
     */
    public $PayOuts;
        
    /**
     * Refund methods
     * @var ApiRefunds 
     */
    public $Refunds;
        
    /**
     * Card registration methods
     * @var ApiCardRegistrations 
     */
    public $CardRegistrations; 
        
    /**
     * Pre-authorization methods
     * @var ApiCardPreAuthorization 
     */
    public $CardPreAuthorizations;
        
    /**
     * Card methods
     * @var ApiCards 
     */
    public $Cards;
    
    /**
     * Events methods
     * @var ApiEvents 
     */
    public $Events;
    
    /**
     * Hooks methods
     * @var ApiHooks 
     */
    public $Hooks;
    
    /**
     * Kyc documents list
     * @var ApiKycDocuments 
     */
    public $KycDocuments;
    
    /**
     * Provides disputes methods
     * @var ApiDisputes 
     */
    public $Disputes;
    
    /**
     * Provides dispute documents methods
     * @var ApiDisputeDocuments 
     */
    public $DisputeDocuments;

    /**
     * Constructor
     */
    function __construct() {

        // default config setup
        $this->Config = new Libraries\Configuration();
        $this->OAuthTokenManager = new Libraries\AuthorizationTokenManager($this);
        
        // API managers
        $this->AuthenticationManager = new Libraries\ApiOAuth($this);
        $this->Clients = new Libraries\ApiClients($this);
        $this->Users = new ApiUsers($this);
        $this->Wallets = new ApiWallets($this);
        $this->Transfers = new ApiTransfers($this);
        $this->PayIns = new ApiPayIns($this);
        $this->PayOuts = new ApiPayOuts($this);
        $this->Refunds = new ApiRefunds($this);
        $this->CardRegistrations = new ApiCardRegistrations($this);
        $this->Cards = new ApiCards($this);
        $this->Events = new ApiEvents($this);
        $this->Hooks = new ApiHooks($this);
        $this->CardPreAuthorizations = new ApiCardPreAuthorizations($this);
        $this->KycDocuments = new ApiKycDocuments($this);
        $this->Disputes = new ApiDisputes($this);
        $this->DisputeDocuments = new ApiDisputeDocuments($this);
    }
}