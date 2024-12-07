
<template>
  <div class="apply_section q-pb-lg" >

    <div class="q-pb-lg" v-if="Object.values(loan).length > 0" >
      <q-stepper
        v-model="step"
        ref="stepper"
        contracted
        color="primary"
        animated
        class="no-header-steper"
      >
        <q-step
          :name="1"
          title="Select campaign settings"
          icon="settings"
          :done="step > 1"
        >
          <div class="w-100 q-mx-none" >
            <q-toolbar class="bg-white text-black q-mt-sm">
              <q-toolbar-title> 
                <div class="w-100 flex flex-center">
                  <span class="text-subtitle1 text-weight-bold q-pt-sm">Datos personales</span>
                </div>
              </q-toolbar-title>
            </q-toolbar>
            <q-list >
              <q-item class="q-py- q-px-sm" >
                <q-item-section>
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-caption text-weight-bold">
                      Nombre completo
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class=" text-caption">{{ loan.user.name }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item class="q-py- q-px-sm" >
                <q-item-section>
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-caption text-weight-bold">
                      N° de documento
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class=" text-caption">{{ numberFormat(loan.user.dni) }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item class="q-py- q-px-sm" >
                <q-item-section>
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-caption text-weight-bold">
                      Número de teléfono
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class=" text-caption">{{ loan.user.phone }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item class="q-py- q-px-sm" >
                <q-item-section>
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                      <div>
                        <span class="text-caption text-weight-bold">
                          Verificar identidad
                        </span>
                        <q-icon
                          :name="loan.user.verify_status == 2 ? icons.sharpVerified : icons.outlinedVerified"
                          size="sm"
                          :color=" loan.user.verify_status > 0 ? 'terciary' :'grey-6'"
                          class="user-verify-user"
                          :class="{'verify-user':loan.user.verify_status == 2, }"
                        />
                      </div>
                    </q-item-label>
                    <div class="flex items-center" >
                      <q-item-label caption lines="1" class="text-caption q-mt-xs">
                        {{ 
                          loan.user.verify_status == 2 
                          ? 'Aprobado'
                          : loan.user.verify_status == 1
                          ? 'Pendiente'
                          : 'No subidos'
                        }}
                      </q-item-label>
                    </div>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item class="q-py- q-px-sm" >
                <q-item-section>
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                      <div>
                        <span class="text-caption text-weight-bold">
                          Estado de cuenta
                        </span>
                      </div>
                    </q-item-label>
                    <q-item-label caption lines="1" class="text-weight-medium text-caption flex items-center">
                      <div class="q-mr-xs ">
                        <q-chip :color="setChip(loan.user.general_status == 1 ? 1 : 0).color" text-color="white" class="q-pt-sm" size="sm">
                          <div class="">
                            {{setChip(loan.user.general_status == 1 ? 1 : 0).text}}
                          </div>
                        </q-chip>  
                        <q-chip color="grey-6" text-color="white" class="q-pt-sm" size="sm" v-if="loan.user.isBlock == 1">
                          <div class="">
                            Bloqueado
                          </div>
                        </q-chip> 
                        <q-chip color="negative" text-color="white" class="q-pt-sm" size="sm" v-if="loan.user.deleted_at">
                          <div class="">
                            Eliminado
                          </div>
                        </q-chip> 
                      </div>
                    </q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
            </q-list>
            <!-- address -->
            <q-toolbar class="bg-white text-black q-mt-sm">
              <q-toolbar-title> 
                <div class="w-100 flex flex-center">
                  <span class="text-subtitle1 text-weight-bold q-pt-sm">Dirección particular</span>
                </div>
              </q-toolbar-title>
            </q-toolbar>
            <q-list >
              <q-item class="q-py- q-px-sm" >
                <q-item-section>
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-caption text-weight-bold">
                      Ciudad
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class=" text-caption">{{ loan.user.city }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item class="q-py- q-px-sm" >
                <q-item-section>
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-caption text-weight-bold">
                      Barrio o localidad
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class=" text-caption">{{ loan.user.locality }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item class="q-py- q-px-sm" >
                <q-item-section>
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-caption text-weight-bold">
                      Calle y N° de casa
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class=" text-caption">{{ loan.user.address }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
            </q-list>
            <!-- professional -->
            <q-toolbar class="bg-white text-black q-mt-sm">
              <q-toolbar-title> 
                <div class="w-100 flex flex-center">
                  <span class="text-subtitle1 text-weight-bold q-pt-sm">Información profesional</span>
                </div>
              </q-toolbar-title>
            </q-toolbar>
            <q-list >
              <q-item class="q-py- q-px-sm" >
                <q-item-section>
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-caption text-weight-bold">
                      Privado - Funcionario público
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class=" text-caption">{{ loan.user.work }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item class="q-py- q-px-sm" >
                <q-item-section>
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-caption text-weight-bold">
                      Cargo
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class=" text-caption">{{ loan.user.office }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item class="q-py- q-px-sm" >
                <q-item-section>
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-caption text-weight-bold">
                      Salario
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class=" text-caption">{{ loan.user.salary }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
            </q-list>
          </div>
        </q-step>
        <q-step
          :name="2"
          title="Select campaign settings"
          icon="settings"
          :done="step > 2"
        >
          <div class="w-100 q-mx-none" >
            <q-toolbar class="bg-white text-black q-mt-sm">
              <q-toolbar-title> 
                <div class="w-100 flex flex-center">
                  <span class="text-subtitle1 text-weight-bold q-pt-sm">Datos laborales</span>
                </div>
              </q-toolbar-title>
            </q-toolbar>
            <q-list >
              <q-item class="q-py- q-px-sm" >
                <q-item-section >
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-body2 text-weight-bold">
                      Empresa
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class="">{{ loan.red_tapes.business }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item class="q-py- q-px-sm" >
                <q-item-section >
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-body2 text-weight-bold">
                      Dirección
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class="">{{ loan.red_tapes.business_address }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item class="q-py- q-px-sm" >
                <q-item-section >
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-body2 text-weight-bold">
                      Número de teléfono
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class="">{{ loan.red_tapes.business_phone }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item class="q-py- q-px-sm" >
                <q-item-section>
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-body2 text-weight-bold">
                      Aporta IPS
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class="q-mt-none">
                      <q-toggle size="md" color="positive" v-model="loan.red_tapes.ips" :val="loan.red_tapes.ips"  />
                    </q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item class="q-py- q-px-sm" >
                <q-item-section>
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-body2 text-weight-bold">
                      Aporta IVA
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class="q-mt-none">
                      <q-toggle size="md" color="positive" v-model="loan.red_tapes.iva" :val="loan.red_tapes.iva"  />
                    </q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
            </q-list>
            <q-toolbar class="bg-white text-black q-mt-sm" v-if="2==3">
              <q-toolbar-title> 
                <div class="w-100 flex flex-center">
                  <span class="text-subtitle1 text-weight-bold ">Referencia laboral</span>
                </div>
              </q-toolbar-title>
            </q-toolbar>
            <q-list v-if="2==3">
              <q-item class="q-py- q-px-sm" >
                <q-item-section >
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-body2 text-weight-bold">
                      Nombre de tu jefe directo
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class="">{{ loan.red_tapes.boss_name }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item class="q-py- q-px-sm" >
                <q-item-section >
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-body2 text-weight-bold">
                      WhatsApp de tu jefe
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class="">{{ loan.red_tapes.boss_phone }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
            </q-list>
            <q-toolbar class="bg-white text-black q-mt-sm" v-if="2==3">
              <q-toolbar-title> 
                <div class="w-100 flex flex-center">
                  <span class="text-subtitle1 text-weight-bold q-pt-sm">Referencia personal</span>
                </div>
              </q-toolbar-title>
            </q-toolbar>
            <q-list v-if="2==3">
              <q-item class="q-py- q-px-sm" >
                <q-item-section >
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-body2 text-weight-bold">
                      Nombre y apellido
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class="">{{ loan.red_tapes.reference_name }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item class="q-py- q-px-sm" >
                <q-item-section >
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-body2 text-weight-bold">
                      Parentesco
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class="">{{ loan.red_tapes.reference_relationship }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item class="q-py- q-px-sm" >
                <q-item-section >
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-body2 text-weight-bold">
                      WhatsApp
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class="">{{ loan.red_tapes.reference_phone }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
            </q-list>
            <q-toolbar class="bg-white text-black q-mt-sm">
              <q-toolbar-title> 
                <div class="w-100 flex flex-center">
                  <span class="text-subtitle1 text-weight-bold ">Comprobante de ingresos</span>
                </div>
              </q-toolbar-title>
            </q-toolbar>
            <q-list >
              <q-item class="q-py- q-px-sm" >
                <q-item-section >
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-body2 text-weight-bold">
                      Certificado laboral firmado
                    </span>
                    </q-item-label>
                    <q-item-label 
                      caption 
                      lines="1" 
                      @click="setDocument(loan.red_tapes.work_certificate)" 
                      class="text-decoration-underline cursor-pointer"
                    >
                      {{ documentFormat(loan.red_tapes.work_certificate) }}
                    </q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item class="q-py- q-px-sm" v-if="loan.red_tapes.ips">
                <q-item-section >
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-body2 text-weight-bold">
                      Último IPS
                    </span>
                    </q-item-label>
                    <q-item-label 
                      caption 
                      lines="1" 
                      @click="setDocument(loan.red_tapes.last_ips)" 
                      class="text-decoration-underline cursor-pointer"
                    >
                      {{ documentFormat(loan.red_tapes.last_ips) }}
                    </q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator v-if="loan.red_tapes.iva"/>
              <q-item class="q-py- q-px-sm" v-if="loan.red_tapes.iva">
                <q-item-section >
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-body2 text-weight-bold">
                      Último IVA
                    </span>
                    </q-item-label>
                    <q-item-label 
                      caption 
                      lines="1" 
                      @click="setDocument(loan.red_tapes.last_iva)" 
                      class="text-decoration-underline cursor-pointer"
                    >
                      {{ documentFormat(loan.red_tapes.last_iva) }}
                    </q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator v-if="loan.red_tapes.ips"/>
            </q-list>
          </div>
        </q-step>
        <q-step
          :name="3"
          title="Select campaign settings"
          icon="settings"
          :done="step > 3"
        >
          <div class="w-100 q-mx-none" >
            <q-toolbar class="bg-white text-black q-mt-sm" v-if="2==3">
              <q-toolbar-title> 
                <div class="w-100 flex flex-center">
                  <span class="text-subtitle1 text-weight-bold q-pt-sm">Informconf</span>
                </div>
              </q-toolbar-title>
            </q-toolbar>
            <q-list v-if="2==3" >
              <q-item class="q-py- q-px-sm" >
                <q-item-section >
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-body2 text-weight-bold">
                      Certificado - reporte de Informconf
                    </span>
                    </q-item-label>
                    <q-item-label 
                      caption 
                      lines="1" 
                      @click="setDocument(loan.red_tapes.informconf)" 
                      class="text-decoration-underline cursor-pointer"
                    >
                      {{ documentFormat(loan.red_tapes.informconf) }}
                    </q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
            </q-list>
            
            <q-toolbar class="bg-white text-black q-mt-sm">
              <q-toolbar-title> 
                <div class="w-100 flex flex-center">
                  <span class="text-subtitle1 text-weight-bold q-pt-sm">Datos para el débito automático</span>
                </div>
              </q-toolbar-title>
            </q-toolbar>
            <q-list v-if="loan.user.card">
              <q-item class="q-py- q-px-sm" >
                <q-item-section >
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-body2 text-weight-bold">
                     Tipo de tarjeta 
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class="">{{ loan.user.card.type == 1 ? 'Tajeta de crédito' : 'tarjeta de débito' }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item class="q-py- q-px-sm" >
                <q-item-section >
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-body2 text-weight-bold">
                      Número de tarjeta
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class="">{{ loan.user.card.number }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item class="q-py- q-px-sm" >
                <q-item-section>
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-body2 text-weight-bold">
                      Vencimiento
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class="">{{ loan.user.card.due_date }} </q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item class="q-py- q-px-sm" >
                <q-item-section>
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-body2 text-weight-bold">
                      CVC
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class="">{{ loan.user.card.cvc }} </q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
            </q-list>
            <div v-else>
              <h6 class="q-py-sm text-center">
                No tiene tarjeta vinculada.🥺
              </h6>
            </div>
            <q-toolbar class="bg-white text-black q-mt-sm">
              <q-toolbar-title> 
                <div class="w-100 flex flex-center">
                  <span class="text-subtitle1 text-weight-bold q-pt-sm">Linea de crédito disponible</span>
                </div>
              </q-toolbar-title>
            </q-toolbar>
            <q-list >
              <q-item class="q-py- q-px-sm" >
                <q-item-section >
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-body2 text-weight-bold">
                     {{ loan.user.is_first_loan ? 'Primer préstamo' : 'Préstamo' }} 
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class="">{{ numberFormat(loan.amount) }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item class="q-py- q-px-sm" >
                <q-item-section >
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-body2 text-weight-bold">
                      Plazo
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class="">{{ loan.days }} días</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item class="q-py- q-px-sm" >
                <q-item-section >
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-body2 text-weight-bold">
                      Cuotas
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class="">{{ loan.quotas }} </q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item class="q-py- q-px-sm" >
                <q-item-section >
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-body2 text-weight-bold">
                      Cobrar cada
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class="">{{ loan.days/loan.quotas }} días </q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
              <q-item class="q-py- q-px-sm" >
                <q-item-section>
                  <div class="flex items-center justify-between">
                    <q-item-label class="q-mt-xs text-weight-bold" >
                    <span class="text-body2 text-weight-bold">
                      Total a devolver
                    </span>
                    </q-item-label>
                    <q-item-label caption lines="1" class="">Gs. {{ numberFormat(loan.amount_to_pay) }}</q-item-label>
                  </div>
                </q-item-section>
              </q-item>
              <q-separator />
            </q-list>
          </div>
        </q-step>
        <template v-slot:navigation>
          <q-stepper-navigation class="q-mt-md flex justify-end q-mx-md-xl q-mb-lg" >
            <q-btn v-if="step > 1"  color="grey-6" @click="$refs.stepper.previous()" class="w-100 q-pa-sm q-mb-md" :class=" loan.status !== '1' && step == 3 ? 'q-mb-xl':''" label="Volver"  />
            <q-btn 
              v-if="step < 3  || loan.status == '1'"
              @click=" step < 3 ? $refs.stepper.next() : changeStatusApplyLoan(2)" 
              :color="step == 3 ? 'green-6' : 'primary'" 
              class="w-100 q-pa-sm q-mb-sm" 
              :label="step == 3 ? 'Aprobar solicitiud' : 'Siguente'" 
              :loading="loading"
              :class="step !== 3 ? 'q-mb-xl' : ''"
            >
              <template v-slot:loading>
                <q-spinner-facebook />
              </template>
            </q-btn>
            <div v-if="step == 3 && loan.status == '1' " class=" w-100 q-pb-md text-weight-bold text-body2">
              Enviarás una notificación push de confirmación
            </div>
            <q-btn 
              v-if="step == 3 && loan.status == '1'"
              @click="changeStatusApplyLoan(1)" 
              color="primary" class="w-100 q-pa-sm q-mb-md" 
              label="Marcar como pendiente" 
              :loading="loading"
            >
              <template v-slot:loading>
                <q-spinner-facebook />
              </template>
            </q-btn>
            <div class="w-100 q-mb-md q-mb-md-none">

              <q-btn 
                v-if="step == 3 && loan.status == '1'"
                @click="changeStatusApplyLoan(0)" 
                color="negative" class="w-100 q-pa-sm q-mb-xl" 
                label="Rechazar solicitud" 
                :loading="loading"
              >
                <template v-slot:loading>
                  <q-spinner-facebook />
                </template>
              </q-btn>
            </div>
          </q-stepper-navigation>
        </template>
      </q-stepper>
    </div>
    <div v-if="sendLoading">
      <doneModal :dialog="sendLoading" :text="textModal" />
    </div>
    <documentModal :dialog="dialog" :document="document" @hiddeModal="hiddeModal" />
  </div>
</template>

<script>
  import { ref, inject, onMounted } from 'vue';
  import { useLoanStore } from '@/services/store/loan.store'
  import { useQuasar } from 'quasar'
  import { useRoute, useRouter } from 'vue-router';
  import doneModal from '@/components/layouts/modals/doneModal.vue';
  import documentModal from '@/components/admin/loan/modals/documentModal.vue';
  import util from '@/util/numberUtil'

  export default {
    components: {
      documentModal,
      doneModal
    },
    setup () {
      const q = useQuasar()
      const router = useRouter()
      const loanStore = useLoanStore();
      const numberFormat = util.numberFormat
      const icons = inject('ionIcons')
      // Data
      const sendLoading = ref(false);
      const dialog = ref(false)
      const loading = ref(false)
      const step = ref(1)
      const loan = ref({})
      const route = useRoute()
      const document = ref('');
      const textModal = ref('');
      // Methods
      const showNotify = (type, message) => {
        q.notify({
          message: message,
          color: type,
          actions: [
            { icon: 'eva-close-outline', color: 'white', round: true, handler: () => { /* ... */ } }
          ]
        })
      }

      const showModal = () => {
        dialog.value = true
      }
      const hiddeModal = () => {
        dialog.value = false
      }
      const setDocument = (doc) => {
        document.value = typeof doc == 'object' ? doc[0] : doc
        showModal()
      }
      const activeLoan = () => {
        loanStore.getLoanById(route.params.id).then((data) => {
          if(!data.code)  throw data
          loan.value = data.data
          loan.value.red_tapes.ips = (loan.value.red_tapes.ips == 1)
          loan.value.red_tapes.iva = (loan.value.red_tapes.iva == 1)
          loan.value.red_tapes.last_ips = JSON.parse(loan.value.red_tapes.last_ips)
          loan.value.red_tapes.last_iva = JSON.parse(loan.value.red_tapes.last_iva)

        }).catch((e) => {
          showNotify('negative', 'error al obtener prestamo activo')
        })
      }
      const setChip = (type) => {
        const chip = [ 
          {
            text: 'Suspendido',
            color: 'terciary'
          },
          {
            text: 'Activo',
            color: 'positive'
          },

        ]
        return chip[type]
      }
      const documentFormat = (document) => {
        if(typeof document == 'object'){
          return lastIpsFormat(document)
        }
        let doc = document.split('/')
        return doc[doc.length - 1]

      }
      const lastIpsFormat = (documents) => {
        let finalName = ''
        documents.forEach((document, index) => {
          const name = document.split('/')
          finalName = finalName + name[name.length - 1]
          finalName += (index + 1) == loan.value.red_tapes.last_ips.length ? '.' : ', '
        });
        return finalName
      }
      const changeStatusApplyLoan = (status) => {
        loading.value = true
        const data = {
          status: status.toString(),
          loan: loan.value.id
        }
        loanStore.changeStatusLoan(data)
        .then((data) => {
          if(data.code !== 200) throw data

          const notify = formatMessage(status)
          loan.value = data.data
          loading.value = false

          showNotify(notify.color, notify.text)

          if(loan.value.status == 2 || loan.value.status == 0) {
            textModal.value = notify.text
            sendLoading.value = true
            setTimeout(() => {
              router.go(-1)
            }, 1000);
          }
            
        })
      }
      const formatMessage = (status) => {
        if(status == 1) return {
          text:'Solicitud se mantiene en pendiente',
          color:'terciary'
        }
        if(status == 2) return {
          text:'Solicitud aprobada',
          color:'positive'
        }
        if(status == 0) return {
          text:'Solicitud rechazada',
          color:'negative'
        }
      }

      onMounted(() => {
        activeLoan()
      })

      return {
        icons,
        loading,
        sendLoading,
        loan,
        dialog,
        step,
        numberFormat,
        document,
        textModal,
        setDocument,
        setChip,
        changeStatusApplyLoan,
        documentFormat,
        hiddeModal,
        formatMessage,
      }
    }
  };
</script>

<style lang="scss">
#logout-button {
  padding: 10px;
}
.apply_section {
  height: 115%; 
  overflow-y: auto;
  &::-webkit-scrollbar {
    display: none;
  }
}
.text-auto-phase {
  word-break: auto-phrase!important;
}
.no-header-steper {
  box-shadow: none!important;

  & .q-stepper__header {
    display: none;
  }
  & .q-stepper__step-inner{
    padding: 0px!important
  }
}
</style>
<style lang="scss" scoped>
.w-100{
  width: 100%!important;
}
.more_money_requiriments {

  background: #e1e9fe;
  border-radius: 15px;

}
</style>