<?php

/**
 * Copyright 2010 SURFnet B.V.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Monolog\Handler\TestHandler;
use Monolog\Logger;
use OpenConext\EngineBlock\Metadata\Entity\IdentityProvider;
use PHPUnit\Framework\TestCase;
use SAML2\Assertion;
use SAML2\Response;

class EngineBlock_Test_Corto_Filter_Command_ValidateAuthnContextClassRefTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    /**
     * @var TestHandler
     */
    private $handler;

    /**
     * @var Logger
     */
    private $logger;

    /**
     * @var EngineBlock_Saml2_ResponseAnnotationDecorator
     */
    private $response;

    public function setUp()
    {
        $this->handler = new TestHandler();
        $this->logger  = new Logger('Test', array($this->handler));

        $assertion = new Assertion();
        $assertion->setAuthnContextClassRef('urn:oasis:names:tc:SAML:2.0:ac:classes:Password');

        $response = new Response();
        $response->setAssertions(array($assertion));

        $this->response = new EngineBlock_Saml2_ResponseAnnotationDecorator($response);
    }

    public function testNoConfiguredBlacklistRegexShouldPass()
    {
        $this->expectNotToPerformAssertions();

        $verifier = new EngineBlock_Corto_Filter_Command_ValidateAuthnContextClassRef($this->logger, '');
        $verifier->setResponse($this->response);
        $verifier->setIdentityProvider(new IdentityProvider('OpenConext'));

        $verifier->execute();
    }

    public function testNotMatchedBlacklistedRegexpPasses()
    {
        $this->expectNotToPerformAssertions();

        $verifier = new EngineBlock_Corto_Filter_Command_ValidateAuthnContextClassRef($this->logger, '/test/');
        $verifier->setResponse($this->response);
        $verifier->setIdentityProvider(new IdentityProvider('OpenConext'));

        $verifier->execute();
    }

    public function testMatchedBlacklistedRegexpThrowsException()
    {
        $this->expectException(EngineBlock_Corto_Exception_AuthnContextClassRefBlacklisted::class);
        $this->expectExceptionMessage('Assertion from IdP contains a blacklisted AuthnContextClassRef "urn:oasis:names:tc:SAML:2.0:ac:classes:Password"');

        $verifier = new EngineBlock_Corto_Filter_Command_ValidateAuthnContextClassRef($this->logger, '/urn:oasis:names:tc:SAML:2\.0:ac:classes:Password/');
        $verifier->setResponse($this->response);
        $verifier->setIdentityProvider(new IdentityProvider('OpenConext'));

        $verifier->execute();
    }

    public function testInvalidBlacklistedRegexpThrowsException()
    {
        $this->expectException(EngineBlock_Exception::class);
        $this->expectExceptionMessage('Invalid authn_context_class_ref_blacklist_regex found in the configuration');

        $verifier = new EngineBlock_Corto_Filter_Command_ValidateAuthnContextClassRef($this->logger, 'an invalid regex/');
        $verifier->setResponse($this->response);
        $verifier->setIdentityProvider(new IdentityProvider('OpenConext'));

        $verifier->execute();
    }
}
