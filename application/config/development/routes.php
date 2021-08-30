<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller']                            				= 'login';
$route['404_override']                                  				= '';
$route['translate_uri_dashes']                          				= FALSE;

$route['logout']                                        				= 'login/logout';

// admin
$route['admin/profile']                                 				= 'admin';
$route['admin/profile/(:any)']                          				= 'admin';

$route['admin/list_admin']                              				= 'admin';
$route['admin/list_admin/(:any)']                       				= 'admin';
$route['admin/list_admin/(:any)/(:any)']                				= 'admin';
$route['admin/list_admin/(:any)/(:any)/(:any)']         				= 'admin';

$route['admin/siswa']                              						= 'admin/siswa';
$route['admin/siswa/(:any)']                       						= 'admin/siswa';
$route['admin/siswa/(:any)/(:any)']                						= 'admin/siswa';
$route['admin/siswa/(:any)/(:any)/(:any)']         						= 'admin/siswa';

$route['admin/kategori_ibadah']                              			= 'admin/kategori';
$route['admin/kategori_ibadah/(:any)']                       			= 'admin/kategori';
$route['admin/kategori_ibadah/(:any)/(:any)']                			= 'admin/kategori';
$route['admin/kategori_ibadah/(:any)/(:any)/(:any)']         			= 'admin/kategori';

$route['admin/rincian_ibadah']                              			= 'admin/rincian';
$route['admin/rincian_ibadah/(:any)']                       			= 'admin/rincian';
$route['admin/rincian_ibadah/(:any)/(:any)']                			= 'admin/rincian';
$route['admin/rincian_ibadah/(:any)/(:any)/(:any)']         			= 'admin/rincian';
$route['admin/rincian_ibadah/(:any)/(:any)/(:any)']         			= 'admin/rincian';

$route['admin/rekap_ibadah']                              				= 'admin/rekap';
$route['admin/rekap_ibadah/(:any)']                       				= 'admin/rekap';
$route['admin/rekap_ibadah/(:any)/(:any)']                				= 'admin/rekap';
$route['admin/rekap_ibadah/(:any)/(:any)/(:any)']         				= 'admin/rekap';
$route['admin/rekap_ibadah/(:any)/(:any)/(:any)']         				= 'admin/rekap';
$route['admin/rekap_ibadah/(:any)/(:any)/(:any)/(:any)']         		= 'admin/rekap';
$route['admin/rekap_ibadah/(:any)/(:any)/(:any)/(:any)/(:any)']     	= 'admin/rekap';

$route['admin/detail_ibadah']                              				= 'admin/detail';
$route['admin/detail_ibadah/(:any)']                       				= 'admin/detail';
$route['admin/detail_ibadah/(:any)/(:any)']                				= 'admin/detail';
$route['admin/detail_ibadah/(:any)/(:any)/(:any)']         				= 'admin/detail';
$route['admin/detail_ibadah/(:any)/(:any)/(:any)']         				= 'admin/detail';
$route['admin/detail_ibadah/(:any)/(:any)/(:any)/(:any)']         		= 'admin/detail';
$route['admin/detail_ibadah/(:any)/(:any)/(:any)/(:any)/(:any)']    	= 'admin/detail';

$route['admin/materi']                              						= 'admin/materi';
$route['admin/materi/(:any)']                       						= 'admin/materi';
$route['admin/materi/(:any)/(:any)']                						= 'admin/materi';
$route['admin/materi/(:any)/(:any)/(:any)']         						= 'admin/materi';
$route['admin/materi/(:any)/(:any)/(:any)/(:any)']  						= 'admin/materi';

// siswa
$route['siswa/profil']                              					= 'siswa/profil';
$route['siswa/profil/(:any)']                       					= 'siswa/profil';
$route['siswa/profil/(:any)/(:any)']                					= 'siswa/profil';

$route['siswa/catatanku']                              					= 'siswa/catatanku';
$route['siswa/catatanku/(:any)']                       					= 'siswa/catatanku';
$route['siswa/catatanku/(:any)/(:any)']                					= 'siswa/catatanku';
$route['siswa/catatanku/(:any)/(:any)/(:any)']         					= 'siswa/catatanku';
$route['siswa/catatanku/(:any)/(:any)/(:any)/(:any)']  					= 'siswa/catatanku';

$route['siswa/rekap']                              						= 'siswa/rekap';
$route['siswa/rekap/(:any)']                       						= 'siswa/rekap';
$route['siswa/rekap/(:any)/(:any)']                						= 'siswa/rekap';
$route['siswa/rekap/(:any)/(:any)/(:any)']         						= 'siswa/rekap';
$route['siswa/rekap/(:any)/(:any)/(:any)/(:any)']  						= 'siswa/rekap';

$route['siswa/materi']                              						= 'siswa/materi';
$route['siswa/materi/(:any)']                       						= 'siswa/materi';
$route['siswa/materi/(:any)/(:any)']                						= 'siswa/materi';
$route['siswa/materi/(:any)/(:any)/(:any)']         						= 'siswa/materi';
$route['siswa/materi/(:any)/(:any)/(:any)/(:any)']  						= 'siswa/materi';
