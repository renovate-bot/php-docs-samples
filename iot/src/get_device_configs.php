<?php

/**
 * Copyright 2018 Google Inc.
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
namespace Google\Cloud\Samples\Iot;

# [START iot_get_device_configs]
use Google\Cloud\Iot\V1\DeviceManagerClient;

/**
 * Lists versions of a device config in descending order (newest first).
 *
 * @param string $registryId IOT Device Registry ID
 * @param string $deviceId IOT Device ID
 * @param string $projectId Google Cloud project ID
 * @param string $location (Optional) Google Cloud region
 */
function get_device_configs(
    $registryId,
    $deviceId,
    $projectId,
    $location = 'us-central1'
) {
    print('Getting device configs' . PHP_EOL);

    // Instantiate a client.
    $deviceManager = new DeviceManagerClient();
    $deviceName = $deviceManager->deviceName($projectId, $location, $registryId, $deviceId);

    $configs = $deviceManager->listDeviceConfigVersions($deviceName);

    foreach ($configs->getDeviceConfigs() as $config) {
        print('Config:' . PHP_EOL);
        printf('    Version: %s' . PHP_EOL, $config->getVersion());
        printf('    Data: %s' . PHP_EOL, $config->getBinaryData());
        printf('    Update Time: %s' . PHP_EOL,
            $config->getCloudUpdateTime()->toDateTime()->format('Y-m-d H:i:s'));
    }
}
# [END iot_get_device_configs]

// The following 2 lines are only needed to run the samples
require_once __DIR__ . '/../../testing/sample_helpers.php';
\Google\Cloud\Samples\execute_sample(__FILE__, __NAMESPACE__, $argv);
