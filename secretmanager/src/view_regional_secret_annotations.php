<?php
/*
 * Copyright 2025 Google LLC.
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

/*
 * For instructions on how to run the full sample:
 *
 * @see https://github.com/GoogleCloudPlatform/php-docs-samples/tree/main/secretmanager/README.md
 */

declare(strict_types=1);

namespace Google\Cloud\Samples\SecretManager;

// [START secretmanager_view_regional_secret_annotations]
// Import the Secret Manager client library.
use Google\Cloud\SecretManager\V1\Client\SecretManagerServiceClient;
use Google\Cloud\SecretManager\V1\GetSecretRequest;

/**
 * @param string $projectId  Your Google Cloud Project ID (e.g. 'my-project')
 * @param string $locationId Your secret Location (e.g. 'us-central1')
 * @param string $secretId   Your secret ID (e.g. 'my-secret')
 */
function view_regional_secret_annotations(string $projectId, string $locationId, string $secretId): void
{
    // Specify regional endpoint.
    $options = ['apiEndpoint' => "secretmanager.$locationId.rep.googleapis.com"];

    // Create the Secret Manager client.
    $client = new SecretManagerServiceClient($options);

    // Build the resource name of the secret.
    $name = $client->projectLocationSecretName($projectId, $locationId, $secretId);

    // Build the request.
    $request = GetSecretRequest::build($name);

    // get the secret.
    $getSecret = $client->getSecret($request);

    // get the annotations
    $annotations = $getSecret->getAnnotations();

    // print the secret name
    printf('Get secret %s with annotation:' . PHP_EOL, $getSecret->getName());
    // we can even loop over all the annotations
    foreach ($annotations as $key => $val) {
        printf("\t$key: $val" . PHP_EOL);
    }
}
// [END secretmanager_view_regional_secret_annotations]

// The following 2 lines are only needed to execute the samples on the CLI
require_once __DIR__ . '/../../testing/sample_helpers.php';
\Google\Cloud\Samples\execute_sample(__FILE__, __NAMESPACE__, $argv);
