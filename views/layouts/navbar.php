<div class="navbarParent">
    <div class="logo">
        <img src="<?=base_url?>assets/logo.png" alt="logo">
    </div>
    <div class="menu">
        <div>
            <div class="option" id="optionInicio">
                <svg width="31" height="29" viewBox="0 0 31 29" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <rect width="31" height="29" fill="url(#pattern0_2339_10)" />
                    <defs>
                        <pattern id="pattern0_2339_10" patternContentUnits="objectBoundingBox" width="1" height="1">
                            <use xlink:href="#image0_2339_10" transform="matrix(0.00974462 0 0 0.0104167 0.0322581 0)" />
                        </pattern>
                        <image id="image0_2339_10" width="96" height="96" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGAAAABgCAYAAADimHc4AAAACXBIWXMAAAsTAAALEwEAmpwYAAACYklEQVR4nO2cwU7bQABE9wSqgO/tkfxSTz32kPa7HorKttQSqZ3MemfX8yQkpCR4Zl5CgmRTSgghhBBCCGELwMPla9ODggbgEfgGfAe+ZNcdAZ6BH/zl8v1zJOwz/tNi/Mov4CUS+oxfiYSO41cioeP4lUjoOH4lEjqOX4mEOz9qnrnOeeV98hG1wTP/5+Vj58r75pXQYvyy7TGR0GL8SiR0HL8SCR3Hr0RCx/ErkdBx/EokdBy/Egkdx69EQsfxK5HQcfzK4SX0HL8cXYLD+IeV4DT+4SQ4jn8YCc7jTy9hhPGnlTDS+NNJGHH8aSSMPP7wEmYYf1gJM40/nIQZxx9Gwszj20s4wvi2Eo40vp2ElacLMuOpgPzuTrfTILecKFsmhXXoXwlbz1Iuk8J6dBJuOUW8TArbuF/Crefnl0lhO7dLeL8Ies0brlQAjemQ7XzzxeTA6T8/2KXkahplu/ZEPZU7D/r1ysURe5aU0CjbZ7+qX+853mcS/vyRtXNJCS2yvd+2lKAZfyFheWXKbiVVtMj24fYqQTv+hwP882ayZ0kVLbIt7rPff2/pVXL0bDKcS2KcTYZzSYyzyXAuiXE2Gc4lMc4mw7kkxtlkOJfEOJsM55IYZ5PhXBLjbDKcS2KcTYZzSYyzyXAuiXE2Gc4lMc4mw7kkxtlkOJfEOJsM55IYZ5PhXBLjbDKcS2KcTYZzSYyzyXAuiXE2Gc4lMc4mw7kkxtlkOJfEOJsM55IYZ5PBjpSJsslwLolxNhnOJTHOJsO5JMbZZDiXxDibDOeSGGcLIYQQQgghhBBCCOWQvAEyTzle7v8enQAAAABJRU5ErkJggg==" />
                    </defs>
                </svg>
                <a href="views/inicio.php">
                    <p>Inicio</p>
                </a>
            </div>
        </div>

        <?php if (trim($_SESSION['user']['rol']) == 'administrador'):  ?>
            <div>
                <a href="views/tipoDocumento/listarTipoDocumentos.php" class="option" id="optionTipoDocumentos">
                    <div class="containerIconOption">
                        <svg width="31" height="28" viewBox="0 0 31 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M25.1875 12.0996V22.75C25.1875 23.4462 24.8813 24.1139 24.3363 24.6062C23.7913 25.0984 23.052 25.375 22.2812 25.375H8.71875C7.94796 25.375 7.20875 25.0984 6.66372 24.6062C6.11869 24.1139 5.8125 23.4462 5.8125 22.75V5.25C5.8125 4.55381 6.11869 3.88613 6.66372 3.39384C7.20875 2.90156 7.94796 2.625 8.71875 2.625H14.6978C15.2114 2.62507 15.7041 2.80938 16.0673 3.13742L24.6202 10.8626C24.9834 11.1907 25.1874 11.6356 25.1875 12.0996Z" stroke="white" stroke-width="2" stroke-linejoin="round"/>
                            <path d="M15.5 3.0625V9.625C15.5 10.0891 15.7041 10.5342 16.0675 10.8624C16.4308 11.1906 16.9236 11.375 17.4375 11.375H24.7031" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div>
                        <p>Tipo Documentos</p>
                    </div>
                </a>
            </div>

            <div>
                <a href="views/area/listarArea.php" class="option" id="optionAreas">
                    <div class="containerIconOption">
                        <svg width="31" height="29" viewBox="0 0 31 29" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <rect width="31" height="29" fill="url(#pattern0_2343_11)"/>
                            <defs>
                                <pattern id="pattern0_2343_11" patternContentUnits="objectBoundingBox" width="1" height="1">
                                    <use xlink:href="#image0_2343_11" transform="matrix(0.00974462 0 0 0.0104167 0.0322581 0)"/>
                                </pattern>
                                <image id="image0_2343_11" width="96" height="96" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGAAAABgCAYAAADimHc4AAAACXBIWXMAAAsTAAALEwEAmpwYAAAEm0lEQVR4nO2bS4sdRRiGK5pJIoaMMoziDRFCDF4IZmEgRhEFV8FL/oFRV25ixqCQIIkEkUCU+ANcCBFFcZsRTFSUKKKIKOrOu5mJLtUZTcwjxdSAi/NVn56q6qqu/h44MBz6vPW+9Z7pLqr7GKMoiqIoiqIoiqIoiqIoAgwAUzIMAFMyDABTMgwAUzIMAFMyDABTMr00XVOWXpquKUsvTdeUpZema8rSS9M1Zeml6ZqytDUtHR8SnkiaIR6yEStkSHgiaYZ4yEaskCHhiaQZ4iEbsUKGhCeSZoiHbMQKGRKeSJohHrIRK2RIeCJphnjIRi9N15Sll6ZrytJL0zVl6aVpAeAS4FpgC7ALOAqcNiVTUwG9RAvoWQHS8SFFMppzwPPAGlMzhRbwI7DVDIECC/gUuMoMhcIK+By4fIzjJ4CdwDG7ygHmgX/ca969dwS4A7jIlExBBfwATDcctxaYcZM8LmfcZ9aaEimkgEXg9oZjHgS+Z+XYzz5gSiNk4roAWAU8BfxLOBfcyqqc01LJBbA0+a8QH6u5ypRA4QUcJB3PmBIotQCWzvn2lOHjBLAb2ARc6l7270eA2YbPWu37c+cssgBgXcMF92tg+xg6dhn6jUfnu+yro0ILmPFM2jvAhhZak8BJj97etGkiF+AJMpIV+JnwrPPtN39yBZqTnv+EM1lXRQUWsNMj13ja8ejuSKFbYwEvCVInImR9W9A+EqpdUwGnBamHI2R9VND+MFS7pgLmBalNEbLeKGjPhWrXVMDfgtT6CFnXC9qLodohpqJMXEQ/iwkL2CBo/xXHfR0FzGU4Bf0ax30dBXwgWNodQfsxQfu9OO7rKOBFwdJswmXo0Tju6yjgPsmT3dsJ0L3To3tv3BT9LmC1eyoi5lbEZcC3gqa9FXpxmjQJCvB8i0ayQk/7kDnZpgQ3+ac8ejMmJ5Krtse31QncjrYbazvGPO1I3/zl7eh1JiclFmCx5+Ux7gPPuu2Fzf+7IbPZvSddcJex2veY3JRagAU4QDr2mxJoO3FtU5pwf9LuaAjHTCm0nbi2SU24v43upkksrNZGUwqpJi4U9xTcIWCB+Cy4Jy7yPy1XYgHA1cBHpOcz4LqcWYsrANgK/EJ32LFuy5W3qAKAW4Dfx5i088C7wB5gG3CFu5k/4f627z3hjrHHNvEbcPOgCwBusNvCDRP1B3AYmGqhO+U+8+cY/wnXp01ZaAEs7f983DBBx0N+uOGuK682jGHvR6+Om67ZWFe87PFgv6ES52Pu1wBPNpyWno011riGuuImz10q+4O8UdiJeihB5l2eEs7FuPvWxkwXfOIZ/40cO5UNO66vpxp3lJEueFwYe4vnCejjHWR/TRjbero19fjLJlJzwS4NhbHtj+yk1U7yX0oC13hWRy+kHn/ZRGq+FMa1a/azwmcOdxJ+ycdzgoe5zldEXQLc7bkITnXoY9pzQb7L1ArwtBD6VAYv7wte9plaAd4SQu/J4GWv4OVNUyvAV0LobRm8bBe8fGFqBfhZCD2dwcuVgpefTK0g32hZk+nmzygWuvaiKIqiKIqiKIqiKIqimN7wH7gE3CuTMZm5AAAAAElFTkSuQmCC"/>
                            </defs>
                        </svg>
                    </div>
                    <div>
                        <p>Areas</p>
                    </div>
                </a>
            </div>

            <div>
                <a href="views/indicaciones/listarIndicaciones.php" class="option" id="optionIndicaciones">
                    <div class="containerIconOption">
                        <svg width="26" height="24" viewBox="0 0 26 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8.35254 3.95996L5.68754 6.42221L4.64754 5.46221L3.47754 6.53996L5.10254 8.03996L5.68754 8.55446L6.27254 8.03921L9.52254 5.03921L8.35254 3.95996ZM12.1875 5.24996V6.74996H22.75V5.24996H12.1875ZM8.35254 9.95996L5.68754 12.423L4.64754 11.46L3.47754 12.54L5.10254 14.04L5.68754 14.5545L6.27254 14.0392L9.52254 11.0392L8.35254 9.95996ZM12.1875 11.25V12.75H22.75V11.25H12.1875ZM8.35254 15.96L5.68754 18.4222L4.64754 17.4622L3.47754 18.54L5.10254 20.04L5.68754 20.5545L6.27254 20.0392L9.52254 17.0392L8.35254 15.9592V15.96ZM12.1875 17.25V18.75H22.75V17.25H12.1875Z" fill="white"/>
                        </svg>
                    </div>
                    <div>
                        <p>Indicaciones</p>
                    </div>
                </a>
            </div>
        <?php endif;  ?>

        <?php if (trim($_SESSION['user']['rol']) == 'administrador'):  ?>
        <div>
            <a href="views/usuario/listarUsuario.php" class="option" id="optionUsuarios">
                <div class="containerIconOption">
                    <svg width="31" height="29" viewBox="0 0 31 29" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <rect width="31" height="29" fill="url(#pattern0_2339_8)"/>
                        <defs>
                            <pattern id="pattern0_2339_8" patternContentUnits="objectBoundingBox" width="1" height="1">
                                <use xlink:href="#image0_2339_8" transform="matrix(0.00974462 0 0 0.0104167 0.0322581 0)"/>
                            </pattern>
                            <image id="image0_2339_8" width="96" height="96" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGAAAABgCAYAAADimHc4AAAACXBIWXMAAAsTAAALEwEAmpwYAAAEe0lEQVR4nO2bX4hVVRSHzziUoWOEmRCWmZD6YCAogRYaQmpBCpH5IIgmTNNT0IM+9hARIQWmPgpBDCSV6ItIQamj0YOaaD6rI2jmaG+lFvPFundLUXftc+7cs2ffu/f64MJw55y1Fut397911ikKwzAMwzAMwzAMwzAMw1DA8BL8h+N3bxQmQFxMgMiYAJExAXIVoMgMTIC4mACRMQEiYwJExgSIjAkQGRMgMiZAZLITAHgaGAKGgbPAGHDPfcbcd8PumnmTEE/6AgBTgDeAEWCc6si1J4CNYiNQbGkLAKwGLtI5F4BVAeJLUwDgIWAf9SIj4lNgao1xpicA8CjwI+E4Bczs9jxEcUwz+T8Tngt1iBAqD1Ec05x2qvzyLwO7gTXAQmC6+8jfa93/5Joyfuh0OkpNgH0VEr+lyo7G7Zy2AqMlNvd0GHMaAtDc7fg4AEybgF0ZGV+VLMwvZi0A0F+y1fwI6Osg1j5gV8l6MCVnATZ5kvN1J8n/jwhfePy8nrMAI545v+1pp2Q60taE41kK4Go744q5LQHi3qb4khieylGAIcXUpRD1G7feXFF8DuYowLBianeYyBs+9yg+P89RgLOKqbVhIm/4fFnxeTpHAcYUUwvCRN7wKSfmVvyaowB3FVMDYSJv+BxQfN7JUYA7EQR4WPH5e44C3FBMPRMm8obPRYrPazkK8JNial2YyBs+X1F8nslRgM8ibEP3Kj735yjA254yRH+gg5hWjngrRwHmeEoRWwPEvV3xJTE8kZ0AJcW4USmg1bz9vKr4OjZBm0kI8JpmDzhYYzlaHupobMhZgH7gvCc5u2p4IPOxx/65rB/ICMDKkq63LycyHblpR0aRhvh8oV27yQkguG4GH6Ount9fcVS96Znz7/NJma2cBHjQNU2VccWVlNe5U+2A+yxylc69FbohhJPAA92Wh6iOgUekLEx4ZN63xixFhFmuqzkUx6UDr6ZYW1KH7aiOgZkVp5F2Ga2rLzRJAWhuGaX77RrhENuDdZQ6QuUhimPgMeAok8d3wOPdlocojoFVwHUmHxkNK7slD1EcA+s9T8ZaJUxK2JuB5cD8f3VHz3ffbXbXVBX0D+DV2HmI4ti9+3WvJEFyWj3kktvX5nqyAjhc4d0yiWFjrDwUMRwDz3seyt9H1oTFNcT7LPANfmQUrmjTbks6jTe4Y2Au8EtJMnbW2R3nRsQ7JdOdxPRk0gK4RMhhSGMMWBow9mWefiTh+6pTXa8KIHtwjd8kQZMQ/xLglieO7UkK4MoMkmRtN7IsePD/xPKcZzq6VeXE3IsCvK/dC7wbPPD/x7PDE897SQkAzABuK7eOhOiCqPgy3zHPKJiRkgBaC8q4bBODB+1fD5hIq0qvCSC1l1YcKSLjOSN8m4QAwGzgL+W21UVkgJeU2P6UjUMKAkjJoRU36mg7qWktuNnuG5S9JMCHyi0Hii7BdV604oMUBNDq/ENFl+DZJBzpGQGMJiZAZEyAyJgAkTEBImMCpC6AYRiGYRiGYRiGYRiGUfQqfwO9eq+UGSl2EAAAAABJRU5ErkJggg=="/>
                        </defs>
                    </svg>
                </div>
                <div>
                    <p>Usuarios</p>
                </div>
            </a>
        </div>
        <?php endif;  ?>

        <div>
            <div class="option" id="optionDocumentos">
                <div class="containerIconOption">
                    <svg width="31" height="29" viewBox="0 0 31 29" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <rect width="31" height="29" fill="url(#pattern0_2339_5)"/>
                        <defs>
                            <pattern id="pattern0_2339_5" patternContentUnits="objectBoundingBox" width="1" height="1">
                                <use xlink:href="#image0_2339_5" transform="matrix(0.00974462 0 0 0.0104167 0.0322581 0)"/>
                            </pattern>
                            <image id="image0_2339_5" width="96" height="96" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGAAAABgCAYAAADimHc4AAAACXBIWXMAAAsTAAALEwEAmpwYAAABxUlEQVR4nO3XIXLEQBBD0ebJ3v8siwK25lwKCJ4KsNVuafSoiX51DXBVREREREREaMJ8bwDf5QoaFoBXOYKOZXkEaFl2R4CeZXUEaFo2R9gVTttjewRsTNtje4Rd2bQ9tkfYVU3bY3uEXdG0PQA+/xzhI/nHLHSALwA/di9B5QD1983vCEoHsDyC2gHsjqB4AKsjqB7A5gjKB7A4gsoBbjDzP2G3dtqem7xrmt3SaXvuUtNMGwqymmbaUOQAOcDRL+C4Lpmhrl0yQ127ZIa6dskMde2SGeradWUoHsLuasWIZGN3tWJEsrG7WjEi2dhdrRiRbOyuVoxINnZXK5mhrl0yQ127ZIa6dskMde2SGeraJTPUtevKUDyE3dWKEcnG7mrFiGRjd7ViRLKxu1oxItnYXa0YkWzsrlYyQ127ZIa6dskMde2SGeraJTPUtUtmqGvXlaF4CLurFSOSjd3VihHJxu5qxYhkY3e1YkSysbtaMSLZ2F2tZIa6dskMde2SGeraJTPUtUtmqGuXzFDXLpmhrl0yQ127ZIa6dskMde2SGeraJTPUtQuHqWlwmJoGh6lpcJiaBoepaXCYioiIiIiIiJL0Cz6P4ItXKcNWAAAAAElFTkSuQmCC"/>
                        </defs>
                    </svg>
                </div>
                <div>
                    <p>Documentos</p>
                    <svg class="svgOption" id="svgOptionDocumentos" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ffffff" d="M246.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-9.2-9.2-22.9-11.9-34.9-6.9s-19.8 16.6-19.8 29.6l0 256c0 12.9 7.8 24.6 19.8 29.6s25.7 2.2 34.9-6.9l128-128z"/></svg>
                </div>
            </div>

            <div class="submenu"  id="submenuDocumentos">
                <div id="options-documentos" class="options">
                    <a href="views/documentos/listarDocumentos.php">
                        <span>
                            <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.5 11C6.95869 11 8.35764 10.4205 9.38909 9.38909C10.4205 8.35764 11 6.95869 11 5.5C11 4.04131 10.4205 2.64236 9.38909 1.61091C8.35764 0.579463 6.95869 0 5.5 0C4.04131 0 2.64236 0.579463 1.61091 1.61091C0.579463 2.64236 0 4.04131 0 5.5C0 6.95869 0.579463 8.35764 1.61091 9.38909C2.64236 10.4205 4.04131 11 5.5 11Z" fill="white"/>
                            </svg>
                        </span>
                        Listar Documentos
                    </a>
                    <a href="views/documentos/pendientesDeRecepcion.php">
                        <span>
                            <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.5 11C6.95869 11 8.35764 10.4205 9.38909 9.38909C10.4205 8.35764 11 6.95869 11 5.5C11 4.04131 10.4205 2.64236 9.38909 1.61091C8.35764 0.579463 6.95869 0 5.5 0C4.04131 0 2.64236 0.579463 1.61091 1.61091C0.579463 2.64236 0 4.04131 0 5.5C0 6.95869 0.579463 8.35764 1.61091 9.38909C2.64236 10.4205 4.04131 11 5.5 11Z" fill="white"/>
                            </svg>
                        </span>
                        Pendientes de Recepción
                    </a>
                    <a href="views/documentos/recepcionados.php">
                        <span>
                            <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.5 11C6.95869 11 8.35764 10.4205 9.38909 9.38909C10.4205 8.35764 11 6.95869 11 5.5C11 4.04131 10.4205 2.64236 9.38909 1.61091C8.35764 0.579463 6.95869 0 5.5 0C4.04131 0 2.64236 0.579463 1.61091 1.61091C0.579463 2.64236 0 4.04131 0 5.5C0 6.95869 0.579463 8.35764 1.61091 9.38909C2.64236 10.4205 4.04131 11 5.5 11Z" fill="white"/>
                            </svg>
                        </span>
                        Recepcionados
                    </a>
                    <a href="views/documentos/enviados.php">
                        <span>
                            <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.5 11C6.95869 11 8.35764 10.4205 9.38909 9.38909C10.4205 8.35764 11 6.95869 11 5.5C11 4.04131 10.4205 2.64236 9.38909 1.61091C8.35764 0.579463 6.95869 0 5.5 0C4.04131 0 2.64236 0.579463 1.61091 1.61091C0.579463 2.64236 0 4.04131 0 5.5C0 6.95869 0.579463 8.35764 1.61091 9.38909C2.64236 10.4205 4.04131 11 5.5 11Z" fill="white"/>
                            </svg>
                        </span>
                        Enviados
                    </a>
                </div>
            </div>
        </div>

        <div>
            <div class="option" id="optionReportes">
                <div class="containerIconOption">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 21H15M9 21V16M9 21H3.6C3.44087 21 3.28826 20.9368 3.17574 20.8243C3.06321 20.7117 3 20.5591 3 20.4V16.6C3 16.4409 3.06321 16.2883 3.17574 16.1757C3.28826 16.0632 3.44087 16 3.6 16H9M15 21V9M15 21H20.4C20.5591 21 20.7117 20.9368 20.8243 20.8243C20.9368 20.7117 21 20.5591 21 20.4V3.6C21 3.44087 20.9368 3.28826 20.8243 3.17574C20.7117 3.06321 20.5591 3 20.4 3H15.6C15.4409 3 15.2883 3.06321 15.1757 3.17574C15.0632 3.28826 15 3.44087 15 3.6V9M9 16V9.6C9 9.44087 9.06321 9.28826 9.17574 9.17574C9.28826 9.06321 9.44087 9 9.6 9H15" stroke="#F8F9FC" stroke-width="1.5"/>
                    </svg>
                </div>
                <div>
                    <p>Reportes</p>
                    <svg class="svgOption <?= ($_SESSION['optionActive'] == "reportes") ? "open" : ""?>" id="svgOptionReportes" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ffffff" d="M246.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-9.2-9.2-22.9-11.9-34.9-6.9s-19.8 16.6-19.8 29.6l0 256c0 12.9 7.8 24.6 19.8 29.6s25.7 2.2 34.9-6.9l128-128z"/></svg>
                </div>
            </div>

            <div class="submenu"  id="submenuReportes">
                <div id="options-reportes" class="options">
                    <?php if (trim($_SESSION['user']['rol']) == 'administrador' || trim($_SESSION['user']['rol']) == 'administrador área'):  ?>
                    <a href="views/reportes/documentosPorArea.php">
                        <span>
                            <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.5 11C6.95869 11 8.35764 10.4205 9.38909 9.38909C10.4205 8.35764 11 6.95869 11 5.5C11 4.04131 10.4205 2.64236 9.38909 1.61091C8.35764 0.579463 6.95869 0 5.5 0C4.04131 0 2.64236 0.579463 1.61091 1.61091C0.579463 2.64236 0 4.04131 0 5.5C0 6.95869 0.579463 8.35764 1.61091 9.38909C2.64236 10.4205 4.04131 11 5.5 11Z" fill="white"/>
                            </svg>
                        </span>
                        Documentos por Area
                    </a>
                    <a href="views/reportes/documentosPorUsuario.php">
                        <span>
                            <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.5 11C6.95869 11 8.35764 10.4205 9.38909 9.38909C10.4205 8.35764 11 6.95869 11 5.5C11 4.04131 10.4205 2.64236 9.38909 1.61091C8.35764 0.579463 6.95869 0 5.5 0C4.04131 0 2.64236 0.579463 1.61091 1.61091C0.579463 2.64236 0 4.04131 0 5.5C0 6.95869 0.579463 8.35764 1.61091 9.38909C2.64236 10.4205 4.04131 11 5.5 11Z" fill="white"/>
                            </svg>
                        </span>
                        Documentos por Usuario
                    </a>
                    <?php endif;  ?>
                    <a href="views/reportes/documentosRecepcionados.php">
                        <span>
                            <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.5 11C6.95869 11 8.35764 10.4205 9.38909 9.38909C10.4205 8.35764 11 6.95869 11 5.5C11 4.04131 10.4205 2.64236 9.38909 1.61091C8.35764 0.579463 6.95869 0 5.5 0C4.04131 0 2.64236 0.579463 1.61091 1.61091C0.579463 2.64236 0 4.04131 0 5.5C0 6.95869 0.579463 8.35764 1.61091 9.38909C2.64236 10.4205 4.04131 11 5.5 11Z" fill="white"/>
                            </svg>
                        </span>
                        Documentos recepcionados
                    </a>
                    <a href="views/reportes/documentosEnviados.php">
                        <span>
                            <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.5 11C6.95869 11 8.35764 10.4205 9.38909 9.38909C10.4205 8.35764 11 6.95869 11 5.5C11 4.04131 10.4205 2.64236 9.38909 1.61091C8.35764 0.579463 6.95869 0 5.5 0C4.04131 0 2.64236 0.579463 1.61091 1.61091C0.579463 2.64236 0 4.04131 0 5.5C0 6.95869 0.579463 8.35764 1.61091 9.38909C2.64236 10.4205 4.04131 11 5.5 11Z" fill="white"/>
                            </svg>
                        </span>
                        Documentos enviados
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

